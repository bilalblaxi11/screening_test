<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('login',get_defined_vars());
    }

    public function attempt(Request $request){
        $customer = Customer::findOrFail($request->customer);
        $request->session()->put('user', $customer);
        return redirect()->route('products');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login');
    }
}
