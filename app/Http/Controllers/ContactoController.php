<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $title = 'Contacto';
        $description = 'Si desea ponerse en contacto con nosotros, por favor complete el siguiente formulario.';
        return view('contacto.index', compact('title', 'description'));
    }
}
