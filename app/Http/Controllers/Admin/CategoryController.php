<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {   $categories=Category::all();
        return view('admin.category.index', ['categories'=>$categories]);
    }
    public function add_category(Request $req)
    {
        $req->validate([
            'category_name'=>'required|unique:categories,category_name',
        ]);
        $category=new Category;
        $category->category_name=$req->category_name;
        $result= $category->save();
        if($result)
        {
            return redirect()->back();
        }

    }

     
    public function edit_category($cat_up_id)
    {
        $up_cat=Category::find($cat_up_id);
        return view('admin.category.category_update', ['category_data'=>$up_cat]);
    }

    public function update_category(Request $req)
    {
        $up_data=Category::find($req->id);
        $up_data->category_name=$req->category_name;
        $result=$up_data->save();
        if($result)
        {
            return redirect('/admin/category')->with('success', 'Update Success');
        }
        
    }
    public function delete_category($del_id)
    {
        $del_result=Category::find($del_id)->delete();
        if($del_id)
        {
            return redirect('/admin/category')->with('success', 'Delete Success');
        }
    }

    public function deactive($id)
    {
        $up_data=Category::find($id);
        $up_data->status=0;
        $result=$up_data->save();
        if($result)
        {
            return redirect('/admin/category')->with('success','Deactive Success..');
        }

    }
    public function active($id)
    {
        $up_data=Category::find($id);
        $up_data->status=1;
        $result=$up_data->save();
        if($result)
        {
            return redirect('/admin/category')->with('success','Active Success..');
        }

    }
}
