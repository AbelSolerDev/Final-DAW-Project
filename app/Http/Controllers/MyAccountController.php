<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites; // Obtener los favoritos del usuario

        return view('myaccount.index', compact('user', 'favorites'));
    }

    public function edit()
    {
        // Implementa la lógica para editar la información del usuario
    }

    public function deleteUser()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect()->route('home')->with('success', 'Account deleted successfully.');
    }
}

