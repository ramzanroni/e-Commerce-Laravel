<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data=Brand::all();
        return view('admin.brand.index', ['brands'=>$data]);
    }
    public function add_brand(Request $req)
    {
        $req->validate([
            'brand_name'=>'required|unique:brands,brand_name',
        ]);
        $data=new Brand;
        $data->brand_name=$req->brand_name;
        $result=$data->save();
        if($result)
        {
            return redirect("/admin/brand")->with('success', 'Brand Add Success.');
        }
    }
    public function delete_brand($del_id)
    {
        $data=Brand::find($del_id)->delete();
        if($data)
        {
            return redirect("/admin/brand")->with('success', 'Brand Delete Success.');
        }
    }
    public function deactive_brand($deactive_id)
    {
        $data=Brand::find($deactive_id);
        $data->status=0;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/brand')->with('success', 'Brand Deactive Success.');
        }
    }
    public function active_brand($active_id)
    {
        $data=Brand::find($active_id);
        $data->status=1;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/brand')->with('success', "Brand Active Success");
        }
    }
    public function find_update($id)
    {
        $edit_drand_data=Brand::find($id);
        return view('admin.brand.brand_update', ['brand_data'=>$edit_drand_data]);
    }
    public function update_brand(Request $req)
    {
        $data=Brand::find($req->id);
        $data->brand_name=$req->brand_name;
        $result=$data->save();
        if($result)
        {
            return redirect('/admin/brand')->with('success', "Brand Update Success");
        }

    }

}
