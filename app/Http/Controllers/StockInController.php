<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang Masuk';
        $data = StockIn::with('product')->latest()->get();
        // return view('stock_in.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Form Barang Masuk';
        $products = Product::all();
        return view('stock_in.create', compact('products', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'note' => 'nullable|string|max:225'
        ]);

        StockIn::create($request->all());

        // update stok
        $product = Product::find($request->product_id);
        $product->increment('stock', $request->qty);

        return redirect()->route('transaction.index')
            ->with('success', 'Barang masuk berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockIn $stockIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockIn $stockIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockIn $stockIn)
    {
        //
    }
}
