<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function coupon()
    {
        $coupon_data=Coupon::all();
        return view('admin.coupon.index', ['coupons'=>$coupon_data]);
    }
    public function add_coupon(Request $request)
    {
        $request->validate([
            'coupon_name'=>'required',
            'discount'=>'required',
        ]);
        $data=new Coupon;
        $data->coupon_name=strtoupper($request->coupon_name);
        $data->discount=$request->discount;
        $result=$data->save();
        if($result)
        {
            return redirect("/admin/coupon")->with('success', 'Coupon Add Success.');
        }
    }

    public function delete_coupon($id)
    {
        $data=Coupon::find($id)->delete();
        if($data)
        {
            return redirect("/admin/coupon")->with('success', 'Coupon Delete Success.');
        }
    }

    public function deactive_coupon($id)
    {
        $data=Coupon::find($id);
        $data->status=0;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/coupon')->with('success', 'Coupon Deactive Success.');
        }
    }
    public function active_coupon($id)
    {
        $data=Coupon::find($id);
        $data->status=1;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/coupon')->with('success', "Coupon Active Success");
        }
    }
    public function edit_coupon($id)
    {
        $coupon_data=Coupon::find($id);
        return view('admin.coupon.coupon_update', ['coupons'=>$coupon_data]);
    }
    public function update_coupon(Request $request)
    {
         $data=Coupon::find($request->id);
        $data->coupon_name= strtoupper($request->coupon_name);
        $data->discount=$request->discount;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/coupon')->with('success', "Coupon Update Success");
        }
    }
}
