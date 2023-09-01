<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Order;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function addProduct(){
        $categories = Category::all('*');
    
        return view('addProduct', compact('categories'));
    }
    

    public function allProduct(){
        $products = Product::all('*');
    
        return view('welcome')->with('products', $products);
    }
    

    public function storeProduct(Request $request){
        $request->validate([
            'category' => 'required|integer|exists:categories,id',
            'productName' => 'required|string|unique:products,productName,NULL,id|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|file'
        ]);

        $extension = $request -> file ('image')->getClientOriginalExtension();
        $filename = $request -> productName.'.'.$extension;
        $request->file('image')->storeAs('/public/products/', $filename);

        Product::create([
            'categoryId' => $request -> category,
            'productName' => $request -> productName,
            'price' => $request -> price,
            'quantity' => $request -> quantity,
            'image' => $filename,
        ]);

        return redirect('/');
    }

    public function editPage(){
        $products = Product::with('category')->get('*');
    
        return view('editPage')->with('products', $products);
    }    

    public function editProduct($id){
        $products = Product::findOrFail($id);
        $categories = Category::all('*');
    
        return view('updateProduct', [
            'product' => $products,
            'categories' => $categories
        ]);
    }
    

    public function updateProduct($id, Request $request){
        $request->validate([
            'productName' => 'required|string|unique:products,productName,NULL,id|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|file'
        ]);

        $products = Product::findOrFail($id);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->productName . '.' . $extension;
        $request->file('image')->storeAs('/public/products/', $filename);
    
        $products->update([
            'categoryId' => $request->category,
            'productName' => $request->productName,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $filename,
        ]);
    
        return redirect(route('homepage'));
    }

    public function deleteProduct($id){
        Product::destroy($id);

        return redirect(route('homepage'));
    }

    public function confirmDelete($id){
        $products = Product::findOrFail($id);

        return view ('confirmDelete')->with('product', $products);
    }

    

   

}
