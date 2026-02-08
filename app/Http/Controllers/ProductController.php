<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $title = 'Products';
        return view('products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Product';
        return view('products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products,code|max:255',
            'name' => 'required|max:255',
            'unit' => 'required|max:50',
            'stock' => 'nullable|integer|min:0'
        ]);

        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock ?? 0,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products)
    {
        $title = 'Product';
        return view('products.show', compact('product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = 'Edit Product';
        return view('products.edit', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|max:255|unique:products,code,' . $product->id,
            'name' => 'required|max:255',
            'unit' => 'required|max:50',
            'stock' => 'nullable|integer|min:0'
        ]);

        $product->update([
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock ?? 0,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
