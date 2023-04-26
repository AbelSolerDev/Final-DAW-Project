<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Contact';
        $description = 'If you wish to contact us, please complete the following form.';
        $location = '123 Main St, Murcia, Spain';
        $phone = '+34 123 456 789';
        $email = 'contact@ilerna.com';
        return view('contact.index', compact('title', 'description', 'location', 'phone', 'email'));
    }
}
