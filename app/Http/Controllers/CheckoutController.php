<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Coupon;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $subtotal=Cart::all()->where('user_ip', request()->ip())->sum(function($product_price){
                return $product_price->qty*$product_price->price;
             });
            $cart_info=Cart::where('user_ip', request()->ip())->latest()->get();
            return view('pages.checkout', ['carts'=>$cart_info], ['subtotal'=>$subtotal]);
            
        }
        else
        {
            return redirect('/login')->with('alert', "Please Login First..");
        }
    }
}
