<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Fiber;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products= Product::orderBy('created_at','DESC')->get();
        return view('products.list',['products'=>$products]);
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
        if($req->image !=""){
            $rules['image'] = 'image';
        }
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        $product = new Product();
        $product->name=$req->name;
        $product->sku=$req->sku;
        $product->price=$req->price;
        $product->description=$req->description;
        $product->save();

        if($req->image !=""){
            $image= $req->image;
            $ext= $image->getClientOriginalExtension();
            $imageName = time(). "." . $ext;
    
            $image->move(public_path('uploads/products'),$imageName);
    
            $product->image=$imageName;
            $product->save();
        }
        
        return redirect()->route('products.index')->with('success','Product Updated Successfully.');
    }
    public function edit(Request $req,$id){
        $product= Product::findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }
    public function update(Request $req,$id){
        $product= Product::findOrFail($id);

        $rules=[
            'name'=>'required|min:4',
            'sku'=>'required|min:3',
            'price'=>'required|numeric',
        ];
        if($req->image !=""){
            $rules['image'] = 'image';
        }
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
        }
        $product->name=$req->name;
        $product->sku=$req->sku;
        $product->price=$req->price;
        $product->description=$req->description;
        $product->save();

        if($req->image !=""){
            File::delete(public_path('uploads/products/'.$product->image));

            $image= $req->image;
            $ext= $image->getClientOriginalExtension();
            $imageName = time(). "." . $ext;
    
            $image->move(public_path('uploads/products'),$imageName);
    
            $product->image=$imageName;
            $product->save();
        }
        
        return redirect()->route('products.index')->with('success','Product Updated Successfully.');
    }
    public function destroy(Request $req,$id){
        $product= Product::findOrFail($id);
        File::delete(public_path('uploads/products/'.$product->image));
        $product->delete();
        return redirect()->route('products.index')->with('success','Product Deleted Successfully.');
    }
    public function deleteAll(){
        Product::truncate();
        return redirect()->route('products.index');
    }
}
