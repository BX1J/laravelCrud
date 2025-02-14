<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.list');
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $req){
        $rules=[
            'name'=>'required|min:4',
            'sku'=>'required|min:3',
            'price'=>'required|numeric',
        ];
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        $product = new Product();
        $product->name=$req->name;
        $product->sku=$req->sku;
        $product->price=$req->price;
        $product->description=$req->description;
        // $product->image=$req->image;
        $product->save();
        return redirect()->route('products.index')->with('success','Product Added Successfully.');
    }
}
