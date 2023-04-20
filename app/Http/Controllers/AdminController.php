<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index ()
    {
        return view('admin.index');
    }

    public function createMobilHome()
    {
        return view('admin.new-mobilhome');
    }

    public function createUser()
    {
        return view('admin.new-user');
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
