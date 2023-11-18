<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('product-detail');
    }

    public function shopingCart()
    {
        $data = [
            'cartItems' => session()->get('cart'),
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

        $cart[$productId] = [
            "name" => $product->name,
            "quantity" => isset($cart[$productId]) ? $cart[$productId]['quantity'] + $request->productQuantity : $request->productQuantity,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);
        $cartCount = collect($cart)->sum('quantity');

        return response()->json([
            'productName' => $product->name,
            'cartCount' => $cartCount,
            'cartHeader' => view('layouts.cart-header', ['cartItems' => $cart])->render(),
            'success' => true
        ]);
    }


    public function cartRemove($rowId)
    {
        $cart = session()->get('cart', []);

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
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (!isset($cart[$rowId])) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        // Increment the quantity
        $cart[$rowId]['quantity']++;

        // Update the session
        session()->put('cart', $cart);

        // Calculate cart count and total
        $cartCount = collect($cart)->sum('quantity');
        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        // Prepare data for the views
        $data = [
            'cartItems' => $cart,
            'cartCount' => $cartCount,
            'total' => $total,
        ];

        // Return the response
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
        $cart = session()->get('cart', []);
    
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
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    
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
        $cart = session()->get('cart', []);
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
    }
}
