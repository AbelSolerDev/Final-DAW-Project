<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuienesSomosController extends Controller
{
    public function index()
    {
        $title = 'Quiénes Somos';
        $description = 'Somos una empresa dedicada a la venta de mobil-homes y casas prefabricadas.';
        return view('quienes-somos.index', compact('title', 'description'));
    }
}
