<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function profile()
    {
        return view('profile');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function shop()
    {
        return view('product');
    }

    public function productDetails()
    {
        return view('product-detail');
    }

    public function shopingCart()
    {
        return view('shoping-cart');
    }
}
