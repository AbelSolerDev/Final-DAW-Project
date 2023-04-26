<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites; // Obtener los favoritos del usuario

        return view('myaccount.index', compact('user', 'favorites'));
    }

    public function editUser()
    {
        $title = "My Account";
        $description = "Edit your user account information";
        $user = Auth::user();
        return view('myaccount.edit', compact('title', 'description', 'user'));
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
    
        return redirect()->route('myaccount.index')->with('success', 'User updated successfully.');
    }    


    public function deleteUser()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect()->route('home')->with('success', 'Account deleted successfully.');
    }
}

