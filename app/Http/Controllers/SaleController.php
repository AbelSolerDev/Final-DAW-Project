<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $title = 'Sale of Mobil-Homes';
        $description = 'Here you can find a list of all mobile homes available for sale.';
        $description2 = 'If you want to see the promotions, register as a user';
        $mobilHomes = [
            'Mobil-Home 1',
            'Mobil-Home 2',
            'Mobil-Home 3',
        ];

        return view('sale.index', compact('title', 'description', 'description2', 'mobilHomes'));
    }
}
