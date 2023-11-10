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

    // function addToCart($id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found!');
    //     }

    //     $cart = session()->get('cart', []);

    //     $cart[$id] = [
    //         "name" => $product->name,
    //         "quantity" => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1,
    //         "price" => $product->price,
    //         "image" => $product->image,
    //     ];

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }

    // function removeCart($id)
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //         session()->put('cart', $cart);
    //     }

    //     return redirect()->back()->with('success', 'Product removed from cart successfully!');
    // }

    // function changeQty($id)
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] = request()->quantity;
    //         session()->put('cart', $cart);
    //     }

    //     return redirect()->back()->with('success', 'Cart quantity updated successfully!');
    // }

    // function incrementCart($id)
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //         session()->put('cart', $cart);
    //     }

    //     return redirect()->back()->with('success', 'Product quantity incremented successfully!');
    // }

    // function decrementCart($id)
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         if ($cart[$id]['quantity'] > 1) {
    //             $cart[$id]['quantity']--;
    //             session()->put('cart', $cart);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Product quantity decremented successfully!');
    // }
}
