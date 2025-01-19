<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('products.index', compact('products'));
    }

    
    public function store(Request $request)
    {
        $product = Product::create($request->all()); 
        return response()->json($product, 201); 
    }

    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id); 
        $product->update($request->all()); 
        return response()->json($product); 
    }

    
    public function destroy($id)
    {
        $product = Product::findOrFail($id); 
        $product->delete(); 
        return response()->json(['message' => 'Product deleted successfully']); 
    }
}
