<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function index()
    {

        $categories = DB::table('categories')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereRaw('products.category_id = categories.id')
                    ->where('products.status', 'active');
            })
            ->get();


        foreach ($categories as $category) {
            $category->products = DB::table('products')
                ->where('category_id', $category->id)
                ->where('status', 'active')
                ->get();
        }
        return view('welcome', ['categories' => $categories]);
    }

    public function profile()
    {
        return view('profile', [
            // 'admins' => Admin::get(),
        ]);
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
        $categories = DB::table('categories')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereRaw('products.category_id = categories.id')
                    ->where('products.status', 'active');
            })
            ->take(6)
            ->get();

        $categories = $categories->filter(function ($category) {
            $category->products = DB::table('products')
                ->where('category_id', $category->id)
                ->where('status', 'active')
                ->get();

            return $category->products->isNotEmpty();
        });

        return view('product', ['categories' => $categories]);
    }

    public function productDetails($slug)
    {
        $data['product'] = Product::where('slug', $slug)->firstOrFail();
        $data['reviews'] = ProductReview::join('users', 'product_reviews.user_id', '=', 'users.id')
            ->where('product_reviews.product_id', $data['product']->id)
            ->where('product_reviews.is_verified', 'yes') // Only select verified reviews
            ->get(['product_reviews.*', 'users.name as user_name']);

        return view('product-detail', $data);
    }


    public function shopingCart()
    {
        $cart = session()->get('cart');
        $data = [
            'cartItems' => $cart['products'],
        ];

        return view('shoping-cart', $data);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cart = session()->get('cart', []);
        $productId = $product->id;

        $cart['products'][$productId] = [
            "name" => $product->name,
            "quantity" => isset($cart[$productId]) ? $cart[$productId]['quantity'] + $request->productQuantity : $request->productQuantity,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);
        $cartCount = collect($cart['products'])->sum('quantity');

        return response()->json([
            'productName' => $product->name,
            'cartCount' => $cartCount,
            'cartHeader' => view('layouts.cart-header', ['cartItems' => $cart['products']])->render(),
            'success' => true
        ]);
    }


    public function cartRemove($rowId)
    {
        $cartAll = session()->get('cart', []);
        $cart = $cartAll['products'];

        if (isset($cart[$rowId])) {
            $cartName = Arr::pull($cart, $rowId)['name'];
            session()->put('cart', $cart);
        }

        $cartCount = array_sum(array_column($cart, 'quantity'));
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total'     => $total,
        ];

        return response()->json([
            'name'       => $cartName,
            'cartCount'  => $cartCount,
            'total'      => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html'       => view('layouts.cart-table', $data)->render(),
            'success'    => true,
        ]);
    }

    public function cartIncrement($rowId)
    {
        $cartAll = session()->get('cart', []);
        $cart = $cartAll['products'];

        if (!isset($cart[$rowId])) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        $cart[$rowId]['quantity']++;

        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];

        return response()->json([
            'name' => $cart[$rowId]['name'],
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'success' => true,
        ]);
    }

    public function cartDecrement($rowId)
    {
        $cartAll = session()->get('cart', []);
        $cart = $cartAll['products'];

        if (!isset($cart[$rowId])) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        $cart[$rowId]['quantity']--;

        $itemRemoved = false;
        if ($cart[$rowId]['quantity'] <= 0) {
            unset($cart[$rowId]);
            $itemRemoved = true;
        }

        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];

        return response()->json([
            'name' => $itemRemoved ? 'Item removed' : $cart[$rowId]['name'],
            'cartCount' => $cartCount,
            'total' => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html' => view('layouts.cart-table', $data)->render(),
            'itemRemoved' => $itemRemoved,
            'success' => true,
        ]);
    }




    public function cartQuantityChange(Request $request)
    {
        $cartAll = session()->get('cart', []);
        $cart = $cartAll['products'];
        if (!isset($cart[$request->id])) {
            return response()->json(['success' => false, 'error' => 'Item not found in cart']);
        }

        $cart[$request->id]['quantity'] = max($request->quantity, 0);

        if ($cart[$request->id]['quantity'] == 0) {
            unset($cart[$request->id]);
        }

        session()->put('cart', $cart);

        $cartCount = 0;
        $total = 0;
        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
            $total += $item['price'] * $item['quantity'];
        }

        $data = ['cartItems' => $cart, 'cartCount' => $cartCount, 'total' => $total];
        return response()->json([
            'name'       => $cart[$request->id]['name'] ?? '',
            'cartCount'  => $cartCount,
            'total'      => $total,
            'cartHeader' => view('layouts.cart-header', $data)->render(),
            'html'       => view('layouts.cart-table', $data)->render(),
            'success'    => true,
        ]);
    }

    public function cartClear()
    {
        Session::forget('cart');
        $cart = session()->get('cart');
        $cartCount = collect($cart['products'])->sum('quantity');
        $total = collect($cart['products'])->sum(function ($item) {
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
    }

    public function checkout()
    {
        $cartAll = session()->get('cart', []);
        $cart = $cartAll['products'];

        $cartCount = 0;
        $total = 0;
        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
            $total += $item['price'] * $item['quantity'];
        }
        $data = ['cartItems' => $cart, 'cartCount' => $cartCount, 'total' => $total];
        // dd( $data['cartItems']);
        return view('checkout',$data);
    }
    
    public function paymentConfirmed()
    {
        return view('payment-confirmed');
    }
}
