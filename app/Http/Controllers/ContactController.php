<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Contact';
        $description = 'If you wish to contact us, please complete the following form.';
        return view('contact.index', compact('title', 'description'));
    }
}
