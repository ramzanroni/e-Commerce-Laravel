<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add_product()
    {
        $brands=Brand::all();
        $categories=Category::all();
        return view('admin.product.add_product', ['brands'=>$brands], ['categories'=>$categories]);
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'product_code'=>'required',
            'price'=>'required',
            'product_quantity'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'product_image_1'=>'required|mimes:jpg,jpeg,png,gif',
            'product_image_2'=>'required|mimes:jpg,jpeg,png,gif',
            'product_image_3'=>'required|mimes:jpg,jpeg,png,gif',
            'sort_description'=>'required',
            'long_description'=>'required',
        ],
    [
        'category_id.required'=>'Select Category Name',
        'brand_id.required'=>'Select Brand Name',
    ]);

    
    $product_image_1=$request->file('product_image_1');
    $image_1_name_gen=hexdec(uniqid()).'.'.$product_image_1->getClientOriginalExtension();
    Image::make($product_image_1)->resize(270,270)->save('fontend/img/product/product_image/'.$image_1_name_gen);
    $image_1_url='fontend/img/product/product_image/'.$image_1_name_gen;

    $product_image_2=$request->file('product_image_2');
    $image_2_name_gen=hexdec(uniqid()).'.'.$product_image_2->getClientOriginalExtension();
    Image::make($product_image_2)->resize(270,270)->save('fontend/img/product/product_image/'.$image_2_name_gen);
    $image_2_url='fontend/img/product/product_image/'.$image_2_name_gen;

    $product_image_3=$request->file('product_image_3');  
    $image_3_name_gen=hexdec(uniqid()).'.'.$product_image_3->getClientOriginalExtension();
    Image::make($product_image_3)->resize(270,270)->save('fontend/img/product/product_image/'.$image_3_name_gen);
    $image_3_url='fontend/img/product/product_image/'.$image_3_name_gen;

    $store_data=new Product;
    $store_data->product_name=$request->product_name;
    $store_data->product_code=$request->product_code;
    $store_data->price=$request->price;
    $store_data->product_quantity=$request->product_quantity;
    $store_data->category_id=$request->category_id;
    $store_data->brand_id=$request->brand_id;
    $store_data->product_slag=strtolower(str_replace(' ', '-', $request->product_name));
    $store_data->sort_description=$request->sort_description;
    $store_data->long_description=$request->long_description;
    $store_data->product_img_1=$image_1_url;
    $store_data->product_img_2=$image_2_url;
    $store_data->product_img_3=$image_3_url;
    $store_data->created_at=Carbon::now();
    $store_data->save();
    return redirect()->back()->with('success', "Add Success");

    }

    public function manage_product()
    {
        $product=Product::orderBy('id', 'desc')->get();
        return view('admin.product.manage_product', ['products'=>$product]);
    }

    public function delete_product($product_id)
    {
        $select_product=Product::find($product_id);
        unlink($select_product->product_img_1);
        unlink($select_product->product_img_2);
        unlink($select_product->product_img_3);
        Product::find($product_id)->delete();

        return redirect()->back()->with("success","Delete Success");

    }

    public function deactive_product($deactive_id)
    {
        $product_data=Product::find($deactive_id);
        $product_data->status=0;
        $product_data->save();
        return redirect()->back()->with("success", "Deactive Success..");        
    }
    public function active_product($active_id)
    {
        $product_data=Product::find($active_id);
        $product_data->status=1;
        $product_data->save();
        return redirect()->back()->with("success", "Active Success..");
    }
    public function edit_product($edit_id)
    {
        $product_info=Product::find($edit_id);
       // return $product_info;
        $brands=Brand::all();
        $categories=Category::all();
        return view('admin.product.edit_product', compact('product_info', 'brands', 'categories'));
        // ['product_info'=>$product_info], ['categories'=>$categories], ['brands'=>$brands]
    }
    public function update_product(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'product_code'=>'required',
            'price'=>'required',
            'product_quantity'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'sort_description'=>'required',
            'long_description'=>'required',
        ],
    [
        'category_id.required'=>'Select Category Name',
        'brand_id.required'=>'Select Brand Name',
    ]);


        $store_data=Product::find($request->id);
        $store_data->product_name=$request->product_name;
        $store_data->product_code=$request->product_code;
        $store_data->price=$request->price;
        $store_data->product_quantity=$request->product_quantity;
        $store_data->category_id=$request->category_id;
        $store_data->brand_id=$request->brand_id;
        $store_data->product_slag=strtolower(str_replace(' ', '-', $request->product_name));
        $store_data->sort_description=$request->sort_description;
        $store_data->long_description=$request->long_description;
        $store_data->updated_at=Carbon::now();
        $result=$store_data->save();  
        if($result)
        {
            return redirect('/admin/manage_product')->with('success', 'Product Update Success..!');
        }
    }

    public function product_image_update(Request $request)
    {
        $product_id=$request->id;
        $old_product_img_1=$request->old_product_img_1;
        $old_product_img_2=$request->old_product_img_2;
        $old_product_img_3=$request->old_product_img_3;
        
        
        if($request->has('product_image_1') && $request->has('product_image_2') && $request->has('product_image_3'))
        {
            unlink($old_product_img_1);
            unlink($old_product_img_2);
            unlink($old_product_img_3);
            $product_image_1=$request->file('product_image_1');
            $image_1_name_gen=hexdec(uniqid()).'.'.$product_image_1->getClientOriginalExtension();
            Image::make($product_image_1)->resize(270,270)->save('fontend/img/product/product_image/'.$image_1_name_gen);
            $image_1_url='fontend/img/product/product_image/'.$image_1_name_gen;

            Product::find($product_id)->update([
                'product_img_1'=>$image_1_url,
                'updated_at'=>carbon::now(),
            ]);
            $product_image_2=$request->file('product_image_2');
            $image_2_name_gen=hexdec(uniqid()).'.'.$product_image_2->getClientOriginalExtension();
            Image::make($product_image_2)->resize(270,270)->save('fontend/img/product/product_image/'.$image_2_name_gen);
            $image_2_url='fontend/img/product/product_image/'.$image_2_name_gen;

            Product::find($product_id)->update([
                'product_img_2'=>$image_2_url,
                'updated_at'=>carbon::now(),
            ]);
            $product_image_3=$request->file('product_image_3');
            $image_3_name_gen=hexdec(uniqid()).'.'.$product_image_3->getClientOriginalExtension();
            Image::make($product_image_3)->resize(270,270)->save('fontend/img/product/product_image/'.$image_3_name_gen);
            $image_3_url='fontend/img/product/product_image/'.$image_3_name_gen;

            Product::find($product_id)->update([
                'product_img_3'=>$image_3_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');

        }
        if($request->has('product_image_1') && $request->has('product_image_2'))
        {
            unlink($old_product_img_1);
            unlink($old_product_img_2);
            $product_image_1=$request->file('product_image_1');
            $image_1_name_gen=hexdec(uniqid()).'.'.$product_image_1->getClientOriginalExtension();
            Image::make($product_image_1)->resize(270,270)->save('fontend/img/product/product_image/'.$image_1_name_gen);
            $image_1_url='fontend/img/product/product_image/'.$image_1_name_gen;

            Product::find($product_id)->update([
                'product_img_1'=>$image_1_url,
                'updated_at'=>carbon::now(),
            ]);
            $product_image_2=$request->file('product_image_2');
            $image_2_name_gen=hexdec(uniqid()).'.'.$product_image_2->getClientOriginalExtension();
            Image::make($product_image_2)->resize(270,270)->save('fontend/img/product/product_image/'.$image_2_name_gen);
            $image_2_url='fontend/img/product/product_image/'.$image_2_name_gen;

            Product::find($product_id)->update([
                'product_img_2'=>$image_2_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');
        }

        if($request->has('product_image_2') && $request->has('product_image_3'))
        {
            unlink($old_product_img_2);
            unlink($old_product_img_3);
            $product_image_2=$request->file('product_image_2');
            $image_2_name_gen=hexdec(uniqid()).'.'.$product_image_2->getClientOriginalExtension();
            Image::make($product_image_2)->resize(270,270)->save('fontend/img/product/product_image/'.$image_2_name_gen);
            $image_2_url='fontend/img/product/product_image/'.$image_2_name_gen;

            Product::find($product_id)->update([
                'product_img_2'=>$image_2_url,
                'updated_at'=>carbon::now(),
            ]);
            $product_image_3=$request->file('product_image_3');
            $image_3_name_gen=hexdec(uniqid()).'.'.$product_image_3->getClientOriginalExtension();
            Image::make($product_image_3)->resize(270,270)->save('fontend/img/product/product_image/'.$image_3_name_gen);
            $image_3_url='fontend/img/product/product_image/'.$image_3_name_gen;

            Product::find($product_id)->update([
                'product_img_3'=>$image_3_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');

        }




        if($request->has('product_image_1'))
        {
            unlink($old_product_img_1);
            $product_image_1=$request->file('product_image_1');
            $image_1_name_gen=hexdec(uniqid()).'.'.$product_image_1->getClientOriginalExtension();
            Image::make($product_image_1)->resize(270,270)->save('fontend/img/product/product_image/'.$image_1_name_gen);
            $image_1_url='fontend/img/product/product_image/'.$image_1_name_gen;

            Product::find($product_id)->update([
                'product_img_1'=>$image_1_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');

        }

        if($request->has('product_image_2'))
        {
            unlink($old_product_img_2);
            $product_image_2=$request->file('product_image_2');
            $image_2_name_gen=hexdec(uniqid()).'.'.$product_image_2->getClientOriginalExtension();
            Image::make($product_image_2)->resize(270,270)->save('fontend/img/product/product_image/'.$image_2_name_gen);
            $image_2_url='fontend/img/product/product_image/'.$image_2_name_gen;

            Product::find($product_id)->update([
                'product_img_2'=>$image_2_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');

        }

        if($request->has('product_image_3'))
        {
            unlink($old_product_img_3);
            $product_image_3=$request->file('product_image_3');
            $image_3_name_gen=hexdec(uniqid()).'.'.$product_image_3->getClientOriginalExtension();
            Image::make($product_image_3)->resize(270,270)->save('fontend/img/product/product_image/'.$image_3_name_gen);
            $image_3_url='fontend/img/product/product_image/'.$image_3_name_gen;

            Product::find($product_id)->update([
                'product_img_3'=>$image_3_url,
                'updated_at'=>carbon::now(),
            ]);
            return redirect('/admin/manage_product')->with('success', 'Image Update Success..!');

        }

        
       

    }
}
