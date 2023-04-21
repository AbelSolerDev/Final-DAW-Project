<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            // Si el usuario es administrador, mostrar la vista de administración
            $users = User::all();
            return view('home', compact('users'));
        } else {
            // Si el usuario no es administrador, mostrar la vista de usuario normal
            return view('home');
        }
    }

}
