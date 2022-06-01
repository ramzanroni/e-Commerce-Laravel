<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function orders()
    {
        $orders=Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }
    public function order_view($order_id)
    {
        $order=Order::findOrFail($order_id);
        $orderItems=OrderItem::where('order_id', $order_id)->get();
        $shipping=Shipping::where('order_id', $order_id)->first();
        return view('admin.order.order_details', compact('order', 'orderItems', 'shipping'));
    }
}
