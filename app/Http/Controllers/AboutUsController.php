<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $title = "About Us";
        $text1 = "Our company was founded by a programmer passionate about creating innovative solutions for everyday problems.
         Faced with the complexity of mobile home sales, he decided to create an online platform that simplifies the sales process.";
        $text2 = "In the region of Murcia, where our company is located, many people are looking for affordable housing solutions 
        that allow them to enjoy rural life. Mobile homes are ideal for this purpose and are becoming increasingly popular. 
        These homes are a sustainable and economical option that require little maintenance.";
        $text3 = "Our mission is to help people find the mobile home of their dreams. We offer a wide variety of options for all 
        tastes and budgets, and our team of experts is always ready to help customers find the perfect solution. We believe that 
        everyone should have the opportunity to live in the countryside and enjoy rural life, which is why we are committed to 
        offering affordable and sustainable housing solutions to fit the needs of each person. If you're looking for a mobile home, 
        check out our sales app!";
        return view('about-us.index', compact('title', 'text1', 'text2', 'text3'));

    }
}

