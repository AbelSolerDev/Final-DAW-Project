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

    public function editMobilHome(Request $request, $id)
    {
        $mobilHome = MobilHome::findOrFail($id);
        $mobilHome->update($request->all());
        
        if ($request->has('discount')) {
            $discount = $request->discount;
            $mobilHome->discount_percentage = ($discount * 100);
            $mobilHome->discounted_price = $mobilHome->price - ($mobilHome->price * $discount);
        } else {
            $mobilHome->discount_percentage = null;
            $mobilHome->discounted_price = null;
        }
        
        $mobilHome->on_sale = $request->has('sold');
        $mobilHome->save();
        
        return view('admin.edit-mobilhome', compact('mobilHome'));
    }
    
    public function deleteMobilHomeImage($id, $imageId)
    {
        $mobilHome = MobilHome::findOrFail($id);
        $image = MobilHomeImage::findOrFail($imageId);
        //$image = $mobilHome->images()->find($imageId);

        if (!$image) {
            return redirect()->back()->with('error', 'The image does not exist.');
        }

        // Eliminar archivo de la imagen del servidor
        Storage::delete($image->image_path);

        // Eliminar entrada de imagen de la base de datos
        $image->delete();

        return redirect()->route('admin.edit-mobilhome', $mobilHome->id)->with('success', 'The image has been successfully removed.');
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
