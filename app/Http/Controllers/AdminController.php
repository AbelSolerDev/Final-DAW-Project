<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index ()
    {   
        $title = 'Administration';
        $description = 'Here you can manage your business by posting new mobilHomes 
        as well as editing or deleting existing ones, you can also review registered users.';
        return view('admin.index', compact('title', 'description'));
    }

    public function viewMobilHome()
    {
        return view('admin.view-mobilhome');
    }
    
    public function createMobilHome()
    {
        return view('admin.new-mobilhome');
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
                // Almacenar la imagen en el sistema de archivos
                $path = Storage::disk('public')->put('mobilhome_images', $image);
                
                // Crear una nueva fila en la tabla mobil_home_images
                $mobilhomeImage = new MobilHomeImage;
                $mobilhomeImage->mobil_home_id = $mobilhome->id;
                $mobilhomeImage->image_path = $path;
                $mobilhomeImage->save();
            }
        }

        return redirect()->route('admin.index')->with('success', 'Mobilhome creada exitosamente.');
    }
}
