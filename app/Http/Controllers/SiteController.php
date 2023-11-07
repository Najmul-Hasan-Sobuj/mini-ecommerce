<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        // Get all categories with their active products
        $categories = DB::table('categories')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereRaw('products.category_id = categories.id')
                    ->where('products.status', 'active'); // If you want to filter by active products
            })
            ->get();

        // Get the products for each category
        foreach ($categories as $category) {
            $category->products = DB::table('products')
                ->where('category_id', $category->id)
                ->where('status', 'active') // If you want to filter by active products
                ->get();
        }
        // dd($categories);
        return view('welcome', ['categories' => $categories]);
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
