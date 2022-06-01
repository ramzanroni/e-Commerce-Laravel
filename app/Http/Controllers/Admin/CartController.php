<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\Contracts\Session\Session;
use App\Models\Cart;
use App\Models\Coupon;
use Session;
class CartController extends Controller
{
    public function add_to_cart(Request $request, $product_id)
    {
        $ip_address=Request()->ip();

        $check=Cart::where('product_id', $product_id)->first();
        if($check)
        {
            Cart::where('product_id', $product_id)->where('user_ip', $ip_address)->increment('qty');
        }
        else{
            $cart_data=new Cart;
        $cart_data->product_id=$product_id;
        $cart_data->qty=1;
        $cart_data->price=$request->price;
        $cart_data->user_ip=$ip_address;
        $cart_data->save();
        }
        return redirect()->back()->with('cart',"Product added on your cart.");        
    }
    public function cart_page()
    {
        $subtotal=Cart::all()->where('user_ip', request()->ip())->sum(function($product_price){
            return $product_price->qty*$product_price->price;
         });
        $cart_info=Cart::where('user_ip', request()->ip())->latest()->get();
        return view('pages.cart', ['carts'=>$cart_info], ['subtotal'=>$subtotal]);
    }
    public function remove_to_cart($remove_id)
    {
        $result=Cart::find($remove_id)->delete();
        return redirect('/cart')->with('success', "Item Remove Form Cart.");
    }

    public function quantity_update(Request $request, $item_id)
    {
        Cart::where('user_ip', request()->ip())->where('id', $request->item_id)->update([
            'qty'=>$request->item_quantity,
        ]);
        return redirect('/cart')->with('success', "Update cart success.");
    }
    public function coupon_apply(Request $request)
    {
        $check=Coupon::where('coupon_name', $request->coupon_name)->first();
        if($check)
        {
            $subtotal=Cart::all()->where('user_ip', request()->ip())->sum(function($product_price){
                return $product_price->qty*$product_price->price;
             });
            Session::put('coupon',[
                'coupon_name'=>$check->coupon_name,
                'coupon_discount'=>$check->discount,
                'coupon_amount'=>$subtotal*($check->discount/100),
            ]);
            return redirect('/cart')->with('success', "Coupon Added Successfully..");
        }
        else
        {
            return redirect('/cart')->with('success', "Invalid Coupon Code.");
        }
    }

    public function remove_coupon()
    {
        if(Session::has('coupon'))
        {
            session()->forget('coupon');
            return redirect('/cart')->with('success', "Remove Coupon Success.");
        }
    }
}
