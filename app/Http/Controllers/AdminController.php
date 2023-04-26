<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\MobilHome;
use App\Models\MobilHomeImage;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index ()
    {   
        return view('admin.index');
    }

    public function viewMobilHome()
    {
        $title = 'Mobil-Home';
        $description = 'Create, Read, Update or Delete Mobil-Homes enrolled in your application';
        /*$mobilHomes = MobilHome::all();*/
        $mobilHomes = MobilHome::with('images')->get();

        return view('admin.view-mobilhome', compact('title', 'description', 'mobilHomes'));
    }
    
    public function createMobilHome()
    {
        return view('admin.new-mobilhome');
    }

    public function updateMobilHome($id){
        $mobilHome = MobilHome::findOrFail($id);
        return view('admin.edit-mobilhome', compact('mobilHome'));
    }

    public function editMobilHome(Request $request, $id)
    {
        $mobilHome = MobilHome::findOrFail($id);
        $mobilHome->fill($request->all());
        $discount_percentage = $mobilHome->discount_percentage ?? 0;
        $discounted_price = $mobilHome->discounted_price ?? null;

        if (round($discount_percentage, 0) === 0) {
            // Mantener el valor actual de discounted_price si discount_percentage es 0
            $mobilHome->discounted_price = 0;
        } elseif ($discount_percentage !== null && $discount_percentage !== 0) {
            $mobilHome->discounted_price = $mobilHome->price - ($mobilHome->price * $discount_percentage / 100);
        } else {
            $mobilHome->discounted_price = 0;
        }

        if ($request->has('discount')) {
            $discount = $request->discount;
            if ($discount_percentage !== null && $discount !== $discount_percentage / 100) {
                // El porcentaje de descuento ha cambiado, recalcular el precio descontado
                $mobilHome->discount_percentage = $discount * 100;
                $mobilHome->discounted_price = $mobilHome->price - ($mobilHome->price * $discount / 100);
            } elseif ($discount_percentage === null || $discount_percentage === 0 ) {
                // No había un porcentaje de descuento registrado previamente
                $mobilHome->discount_percentage = $discount * 100;
                $mobilHome->discounted_price = $mobilHome->price - ($mobilHome->price * $discount / 100);
            } elseif (round($discount_percentage, 0) === 0 && empty($discount)) {
                // Se ha seleccionado "No discount", borrar el valor de discounted_price
                $mobilHome->discounted_price = $mobilHome->price;
            }
            // Nueva condición para establecer el valor de discounted_price en 0 si es igual a price
            if (round($mobilHome->discounted_price, 2) === round($mobilHome->price, 2)) {
                $mobilHome->discounted_price = 0;
            }
        } else {
            // No se ha seleccionado un porcentaje de descuento
            $mobilHome->discount_percentage = null;
            if ($discount_percentage === null) {
                $mobilHome->discounted_price = null;
            }
            // Nueva condición para establecer el valor de discounted_price en 0 si es igual a price
            if (round($mobilHome->discounted_price, 2) === round($mobilHome->price, 2)) {
                $mobilHome->discounted_price = 0;
            }
        }
        //volver al porcentaje original en unidades para poder guardarlo en la base de datos
        $mobilHome->discount_percentage = ($mobilHome->discount_percentage / 100);

        // GESTIÓN DE VENDIDO //
        $oldOnSale = $mobilHome->on_sale;
        $mobilHome->on_sale = $request->has('sold');
        if ($mobilHome->on_sale) {
            $mobilHome->available = 0;
        } else {
            $mobilHome->available = $request->input('available', 0);
            // Si on_sale cambia de 1 a 0, establecer available en 1
            if ($oldOnSale && !$mobilHome->on_sale) {
                $mobilHome->available = 1;
            }
        }
        

        // GESTIÓN DE IMAGENES //
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            if (!is_null($images) && (is_array($images) || is_object($images))) {
                foreach ($images as $image) {
                    // Obtener el nombre de archivo original
                    $filename = $image->getClientOriginalName();
        
                    // Almacenar la imagen en el sistema de archivos
                    //$path = $image->storeAs('mobilhome_images', uniqid() . '-' . $filename);
                    $path = $image->storeAs('mobilhome_images', $filename, 'public');
        
                    // Obtener la ruta completa de la imagen almacenada
                    $fullPath = 'mobilhome_images/' . basename($path);
        
                    // Crear una nueva fila en la tabla mobil_home_images
                    $mobilhomeImage = new MobilHomeImage;
                    $mobilhomeImage->mobil_home_id = $mobilHome->id;
                    $mobilhomeImage->image_path = $fullPath;
                    $mobilhomeImage->save();
                }
            }
        }
        
        if (!is_null($request->input('images'))) {
            foreach ($request->input('images') as $imageId) {
                $image = MobilHomeImage::findOrFail($imageId);
                Storage::delete($image->image_path);
                $image->delete();
            }
        }
        

        $mobilHome->save();

        return redirect()->route('admin.view-mobilhome')->with('success', 'The mobile home has been satisfactorily modified.');
    }


    public function deleteMobilHome($id)
    {
        $mobilHome = MobilHome::findOrFail($id);
        $mobilHome->delete();
        return redirect()->route('admin.view-mobilhome')->with('success', 'MobilHome deleted successfully.');
    }
    
    
    public function storeMobilHome(Request $request)
    {
        // Validar el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'discount_percentage' => 'nullable|integer|min:1|max:100',
            'featured' => 'boolean',
            'favorite' => 'boolean',
            'available' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Crear la mobilhome
        $mobilhome = MobilHome::create($validatedData);

        // Manejar las imágenes
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Obtener el nombre de archivo original
                $filename = $image->getClientOriginalName();

                // Almacenar la imagen en el sistema de archivos
                //$path = $image->storeAs('mobilhome_images', uniqid() . '-' . $filename);
                $path = $image->storeAs('mobilhome_images', $filename, 'public');

                // Obtener la ruta completa de la imagen almacenada
                $fullPath = 'mobilhome_images/' . basename($path);

                // Crear una nueva fila en la tabla mobil_home_images
                $mobilhomeImage = new MobilHomeImage;
                $mobilhomeImage->mobil_home_id = $mobilhome->id;
                $mobilhomeImage->image_path = $fullPath;
                $mobilhomeImage->save();
            }
        }

        return redirect()->route('admin.view-mobilhome')->with('success', 'Mobilhome creada exitosamente.');
    }


    









    public function viewUser()
    {
        $title = 'Users';
        $description = 'Create, Read, Update or Delete Users enrolled in your application';
        $users = User::all();
        return view('admin.view-user', compact('title', 'description', 'users'));
    }

    public function createUser()
    {
        $title = 'Create User';
        $description = 'Please fill out the form below to create a new user';
        return view('admin.new-user', compact('title', 'description'));
    }

    public function storeUser(Request $request)
    {
        // Validar el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Crear el usuario
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->is_admin = $request->has('admin');
        $user->save();

        return redirect()->route('admin.view-user')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $title = 'Edit User';
        $description = 'Edit an existing user';
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('title', 'description', 'user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validar el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();
    
        return redirect()->route('admin.view-user')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.view-user')->with('success', 'User deleted successfully.');
    }


            
    
}
