<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $product->save();

        return redirect()->route('product.show')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $products = Product::all();

        return view('product.show', compact('products'));
    }

    public function edit($id)
    {
        $products = product::findOrFail($id);

        return view('product.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|nullable|string',
        ]);

        $product = product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
        ]); 

        $product->save();

        return redirect()->route('product.show')->with('success', 'product updated successfully!');
    }

    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.show')->with('success', 'product deleted successfully!');
    }
}
