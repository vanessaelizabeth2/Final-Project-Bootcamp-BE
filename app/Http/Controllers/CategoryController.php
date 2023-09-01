<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function addCategory(Request $request){
        $categories = Category::all('*');
    
        return view('addCategory', compact('categories'));
    }
    

    public function storeCategory(Request $request){
        $request->validate([
            'category' => 'required|string|unique:categories,category',
        ]);

        Category::create([
            'category' => $request -> category
        ]);

        return redirect (route('homepage'));
    }
    
}
