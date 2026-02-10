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
        $title = 'Products';
        $products = Product::latest()->paginate(10);
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
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:products,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        Product::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'unit' => $validated['unit'],
            'stock' => $validated['stock'] ?? 0,
            'min_stock' => $validated['min_stock'] ?? 0,
            'price' => $validated['price'] ?? 0,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
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
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        $product->update($validated);

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
