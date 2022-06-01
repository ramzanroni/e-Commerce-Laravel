<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function add_wishlist($product_id)
    {
        if(Auth::check())
        {
            $user_id=Auth::id();
            $check=Wishlist::where('product_id', $product_id)->first();
            if($check)
            {
                return redirect()->back()->with('cart', "Product already added wishlist.");
            }
            else
            {
            $wishlist_data=new Wishlist;
            $wishlist_data->user_id=$user_id;
            $wishlist_data->product_id=$product_id;
            $wishlist_data->save();
            return redirect()->back()->with('cart', "Product added wishlist.");
            }
        }
        else
        {
            return redirect('/login')->with('alert', "Please Login First..");
        }
        
    }
    public function wish_page()
    {
        $wishlists=Wishlist::where('user_id', Auth::id())->latest()->get();
        return view('pages.wishlist', ['wishlists'=>$wishlists]);
    }
    public function remove_wistlist_item($wishlist_id)
    {
        $result=Wishlist::where('id', $wishlist_id)->delete();
        return redirect()->back()->with('remove', 'Remove Wishlist item success.');
    }
}
