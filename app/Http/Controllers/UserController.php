<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function user_order()
    {
        $orders=Order::where('user_id', Auth::id())->latest()->get();
        return view('pages.profile.order', compact('orders'));
    }

    public function order_view($id)
    {
        $order=Order::findOrFail($id);
        $order_items=OrderItem::with('product')->where('order_id', $id)->get();
        $shipping=Shipping::where('order_id', $id)->first();
        return view('pages.profile.order-view', compact('order', 'order_items', 'shipping'));
    }
}
