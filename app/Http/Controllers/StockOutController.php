<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Barang Keluar';
        $stockOuts = StockOut::with('product')->latest()->get();
        $products = Product::all();
        return view('stock_out.index', compact('stockOuts', 'title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Form Barang Keluar';
        $products = Product::all();
        return view('stock_out.create', compact('products', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1',
            'reference_no' => 'required|string|max:225',
            'date' => 'required|date',
            'note' => 'nullable|string|max:225'
        ]);

        $product = Product::find($request->product_id);

        if ($request->qty > $product->stock) {
            return back()->withErrors('Stok tidak mencukupi');
        }

        StockOut::create($request->all());

        $product->decrement('stock', $request->qty);
        return redirect()->route('stock_out.index')
            ->with('success', 'Barang keluar berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockOut $stockOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOut $stockOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockOut $stockOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockOut $stockOut)
    {
        //
    }
}
