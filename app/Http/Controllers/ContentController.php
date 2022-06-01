<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ContentController extends Controller
{
    //
    public function index()
    {
        $products=Product::where('status', 1)->latest()->get();
        $categories=Category::where('status', 1)->latest()->get();
        $latest_products=Product::where('status', 1)->latest()->limit(3)->get();
        return view('pages.index', compact('products', 'categories', 'latest_products'));
    }
    public function product_details($product_id)
    {
         $product=Product::find($product_id);
         $product_category=$product->category_id;
         $related_products=Product::where('category_id', $product_category)->where('id', '!=', $product_id)->latest()->get();
       return view('pages.product_details', compact('product', 'related_products'));
    }
    public function shop()
    {
        $products=Product::where('status', 1)->latest()->get();
        $productsp=Product::where('status', 1)->paginate(6);
        $categories=Category::where('status', 1)->latest()->get();
        return view('pages.shop', compact('products', 'categories', 'productsp'));
    }
   
}
