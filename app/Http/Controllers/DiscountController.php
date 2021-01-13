<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{

    public function calculateDiscount(Request $request){

        $total = (float)@$request->total;
        $totalDiscount = false;
        if($total >= 1000) {
            $totalDiscount = ($total * 0.1);
            $total = $total - $totalDiscount;
        }
        $items = $request->items;

        $productIDs = array_map(function ($item){
            return $item['product-id'];
        }, $items);

        $catByIds = Product::whereIn('uuid', $productIDs)->pluck('category_id','uuid');

        $toolMinUnitPrice = $toolsQuantity = 0;
        $toolDiscountItem = $toolDiscounts = $switchDiscounts = [];

        foreach ($items as $item){
            $pid = $item['product-id'];
            $quantity = (int)$item['quantity'];
            $unitPrice = (float)$item['unit-price'];
            if($catByIds[$pid] == 1){
                $toolsQuantity += $quantity;
                if($toolMinUnitPrice == 0 || ($toolMinUnitPrice != 0 && $toolMinUnitPrice > $unitPrice)){
                    $toolMinUnitPrice = $unitPrice;
                    $toolDiscountItem = $item;
                }
            } elseif($catByIds[$pid] == 2){
                if($quantity >= 5) {
                    $totalFives = $quantity - $quantity % 5;
                    Log::info($totalFives);
                    for($i =0; $i < $totalFives; $i += 5) {
                        if(!isset($switchDiscounts[$pid]['product-id'])){
                            $switchDiscounts[$pid]['qty'] = 1;
                            $switchDiscounts[$pid]['product-id'] = $pid;
                        } else $switchDiscounts[$pid]['qty']++;
                    }
                }
            }
        }

        if($toolsQuantity >= 2){
            $discount = (float)$toolDiscountItem['price'] * 0.2;
            $pid = $toolDiscountItem['product-id'];
            $toolDiscounts = ['product-id' => $pid, 'discount' => $discount];
            $total = $total - $discount;
        }

        return response()->json([
            'switch_discount' => !empty($switchDiscounts) ? array_values($switchDiscounts) : [],
            'tool_discount' => $toolDiscounts,
            'total_discount' => $totalDiscount,
            'total' => $total
        ]);
    }




}
