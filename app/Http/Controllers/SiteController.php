<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        // Get categories with their active products
        $categories = DB::table('categories')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereRaw('products.category_id = categories.id')
                    ->where('products.status', 'active'); // If you want to filter by active products
            })
            ->take(6)
            ->get();

        // Filter out categories with no active products
        $categories = $categories->filter(function ($category) {
            $category->products = DB::table('products')
                ->where('category_id', $category->id)
                ->where('status', 'active') // If you want to filter by active products
                ->get();

            return $category->products->isNotEmpty(); // Only keep categories with active products
        });

        return view('product', ['categories' => $categories]);
    }

    public function productDetails($slug)
    {
        return view('product-detail');
    }

    public function shopingCart()
    {
        return view('shoping-cart');
    }

    function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->name,
            "quantity" => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    function addToWishlist($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $wishlist = session()->get('wishlist', []);

        $wishlist[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    function removeWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }

    // function removeCart($id)
    // {
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //         session()->put('cart', $cart);
    //     }

    //     return redirect()->back()->with('success', 'Product removed from cart successfully!');
    // }

    function changeQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = request()->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart quantity updated successfully!');
    }

    function incrementCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product quantity incremented successfully!');
    }

    function decrementCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Product quantity decremented successfully!');
    }
}
