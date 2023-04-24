<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilHome;
use Illuminate\Support\Str;


class SaleController extends Controller
{
    public function index()
    {
        $title = 'Sale of Mobil-Homes';
        $description = 'Here you can find a list of all mobile homes available for sale.';
        $description2 = 'If you want to see the promotions, register as a user';
        $mobilHomes = MobilHome::where('on_sale', false)
                                ->where('available', true)
                                ->orderBy('created_at', 'desc')
                                ->paginate(12);

        return view('sale.index', compact('title', 'description', 'description2', 'mobilHomes'));
    }
    public function show(MobilHome $mobilHome)
    {
        return view('sale.show', compact('mobilHome'));
    }
    
}

/*Este código utiliza el modelo MobilHome para obtener los móviles que están en venta (on_sale = true)
 y que están disponibles (available = true), ordenándolos por fecha de creación (created_at) de forma 
 descendente. Luego, utiliza la función paginate(12) para obtener 12 móviles por página y los envía a 
 la vista sale.index mediante la función compact().*/