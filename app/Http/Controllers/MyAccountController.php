<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites; // Obtener los favoritos del usuario

        return view('myaccount.index', compact('user', 'favorites'));
    }

    public function favorites()
    {
        // Implementa la lógica para mostrar los favoritos del usuario
    }

    public function edit()
    {
        // Implementa la lógica para editar la información del usuario
    }

    public function delete()
    {
        // Implementa la lógica para eliminar la cuenta del usuario
    }
}

