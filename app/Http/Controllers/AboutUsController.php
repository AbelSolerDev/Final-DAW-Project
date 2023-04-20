<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $title = 'About Us';
        $text1 = 'Our company was founded by a programmer who has a passion for creating innovative solutions for everyday problems. 
        One day, his friend, who is an avid fan of caravans and mobile homes, approached him with a problem: selling his mobile homes was a 
        complicated and time-consuming process. That´s when our founder had an idea: creating an online platform that simplifies the process 
        of buying and selling mobile homes.';

        $text2 = 'Our company is located in the region of Murcia, which is known for its beautiful countryside and mild climate. 
        Many people in the region are looking for affordable housing solutions that allow them to live in the countryside and enjoy the benefits 
        of rural life. Mobile homes and prefabricated houses are the perfect solution for those who want to live in the countryside without breaking the bank.';
        
        $text3 = 'In recent years, the demand for mobile homes and prefabricated houses has been on the rise. Many people are looking for affordable 
        and sustainable housing solutions that allow them to live in a more eco-friendly and self-sufficient way. Mobile homes and prefabricated houses 
        are a great way to achieve this goal, as they are relatively cheap to buy, easy to install, and require minimal maintenance.';
        
        $text4 = 'Our mission is to make it easy for people to find their dream mobile home or prefabricated house. We offer a wide range of products 
        to suit all tastes and budgets, and our team of experts is always on hand to help customers find the perfect solution for their needs. Whether 
        you are looking for a small and cozy mobile home for a weekend getaway, or a large and spacious prefabricated house for a permanent residence, 
        we have something for everyone.';
        
        $text5 = 'At our company, we believe that everyone should have the opportunity to live in the countryside and enjoy the benefits of rural life. 
        We are committed to making this dream a reality for as many people as possible, by offering affordable and sustainable housing solutions that 
        are tailored to their needs.';
        return view('about-us.index', compact('title', 'text1', 'text2', 'text3', 'text4', 'text5'));
    }
}
