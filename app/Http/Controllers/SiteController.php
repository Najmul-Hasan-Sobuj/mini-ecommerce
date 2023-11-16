<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $data = [
            'cartItems' => session()->get('cart'),
        ];
        // dd($data['cartItems']);
        return view('shoping-cart', $data);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->productId);

        if (!$product) {
            return response()->json(['error' => true]);
        }

        $cart = session()->get('cart', []);
        $cart[$request->productId] = [
            "name" => $product->name,
            "quantity" => $request->productQuantity,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);
        $cartCount = collect(session('cart'))->sum('quantity');
        $data = [
            'cartItems' => session()->get('cart'),
        ];
        // toastr()->success('Successfully Added to Your Cart');

        return response()->json([
            'name' => $product->name,
            'cartCount' => $cartCount,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'success' => true
        ]);
    }




    public function cartRemove($rowId)
    {
        $cart = session()->get('cart', []);
        $cartName = $cart[$rowId]['name'];
        // Check if the item exists in the cart
        if (isset($cart[$rowId])) {
            // Remove the item from the cart
            unset($cart[$rowId]);

            // Update the cart in the session
            session()->put('cart', $cart);
        }

        // Recalculate the total and cart count
        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Prepare the data for the view
        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];

        // Response
        return response()->json([
            'name' => $cartName,
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
    }

    public function cartIncrement($rowId)
    {

        $cart = session()->get('cart', []);
        $cartName = $cart[$rowId]['name'];
        // Check if the item exists in the cart
        if (isset($cart[$rowId])) {
            // Remove the item from the cart
            $cart[$rowId]['quantity'] = $cart[$rowId]['quantity'] + 1;

            // Update the cart in the session
            session()->put('cart', $cart);
        }
        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Prepare the data for the view
        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];
        // Response
        return response()->json([
            'name' => $cartName,
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
    } // End Method


    public function cartDecrement($rowId)
    {
        $cart = session()->get('cart', []);
        $cartName = $cart[$rowId]['name'];
        // Check if the item exists in the cart
        if (isset($cart[$rowId])) {
            // Remove the item from the cart
            $cart[$rowId]['quantity'] = $cart[$rowId]['quantity'] - 1;
            if ($cart[$rowId]['quantity'] == 0) {
                unset($cart[$rowId]);
            }
            // Update the cart in the session
            session()->put('cart', $cart);
        }
        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Prepare the data for the view
        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];
        // Response
        return response()->json([
            'name' => $cartName,
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
        // return response()->json('Increment');
    } // End Method


    public function cartQuantityChange(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartName = $cart[$request->id]['name'];
        // Check if the item exists in the cart
        if (isset($cart[$request->id])) {
            // Remove the item from the cart
            $cart[$request->id]['quantity'] = $request->quantity;
            if ($cart[$request->id]['quantity'] == 0) {
                unset($cart[$request->id]);
            }
            // Update the cart in the session
            session()->put('cart', $cart);
        }
        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Prepare the data for the view
        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];
        // Response
        return response()->json([
            'name' => $cartName,
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
        // return response()->json('Increment');
    } // End Method



    public function cartClear()
    {
        Session::forget('cart');
        $cartCount = collect(session()->get('cart'))->sum('quantity');
        $total = collect(session()->get('cart'))->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $data = [
            'cartItems' => [],
            'total' => 0,
        ];

        return response()->json([
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
    } // End Method

}
