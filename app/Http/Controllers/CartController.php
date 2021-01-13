<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request){
        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];
        $products = [];
        foreach ($cart as $pid => $quantity){
            $product = Product::find($pid);
            if($product != false){
                $products[] = [
                  'detail' => $product,
                  'qty' => $quantity,
                ];
            }
        }

        return view('cart',get_defined_vars());
    }

    public function addToCart(Product $product, Request $request){
        $request->validate([
            'qty' => 'required|integer|min:1|max:10000000'
        ]);

        //$customer = $request->session()->get('user');
        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];
        $cart[$product->id] = isset($cart[$product->id]) ?
            $cart[$product->id] + $request->qty :
            $request->qty;

        $request->session()->put('cart', $cart);

        return redirect()->back()->with(['msg' => $product->uuid . " product added to cart."]);
    }

    public function removeFromCart(Product $product, Request $request){

        //$customer = $request->session()->get('user');
        $cart = $request->session()->has('cart') ? $request->session()->get('cart') : [];
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->back()->with(['msg' => $product->uuid . " product removed from cart."]);
    }
}
