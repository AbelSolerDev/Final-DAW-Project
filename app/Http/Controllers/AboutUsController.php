<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $title = 'About Us';
        $description = 'We are a company dedicated to the sale of mobile homes and prefabricated houses.';
        return view('about-us.index', compact('title', 'description'));
    }
}
