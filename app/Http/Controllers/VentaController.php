<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $title = 'Venta de Mobil-Homes';
        $description = 'Aquí puedes encontrar una lista de todos los mobil-homes disponibles para la venta.';
        $description2 = 'Si quieres ver las promociones, registrate como usuario';
        $mobilHomes = [
            'Mobil-Home 1',
            'Mobil-Home 2',
            'Mobil-Home 3',
        ];

        return view('venta.index', compact('title', 'description', 'description2', 'mobilHomes'));
    }
}
