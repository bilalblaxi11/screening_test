<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Request $request){
        $customer = $request->session()->get('user');
        $cartItems = $request->session()->has('cart') ? $request->session()->get('cart') : [];

        $items = [];
        $total = 0;

        foreach ($cartItems as $pid => $quantity){
            $product = Product::find($pid);
            if($product != false){
                $productTotal = (float)$product->price * (float)$quantity;
                $items[] = [
                    'product-id' => $product->uuid,
                    'quantity' => $quantity,
                    'unit-price' => $product->price,
                    'price' => $productTotal,
                ];
                $total += $productTotal;
            }
        }

        $request = [
            'id' => 1, //order_id
            'customer-id'=> $customer->id,
            'items' => $items,
            'total' => $total,
        ];

        $url = env("API_PATH", "http://localhost:8001"). "/api/calculate_discount";
        //dd($url);

        $response = Http::post($url, $request)->throw(function ($res, $e){
            Log::error($e);
        })->json();
        dd($response);
        return view('checkout',get_defined_vars());
    }
}
