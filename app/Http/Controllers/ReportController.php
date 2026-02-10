<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock()
    {
        $title = "Laporan Stok";
        $products = Product::orderBy('name', 'asc')->get();

        $totalProducts = $products->count();
        $totalItems = $products->sum('stock');
        $lowStock = $products->filter(function ($product) {
            return $product->stock <= $product->min_stock;
        })->count();
        $priceStock = $products->sum(function ($product) {
            return $product->price * $product->stock;
        });


        return view('reports.stock', compact(
            'title',
            'products',
            'totalProducts',
            'totalItems',
            'lowStock',
            'priceStock'
        ));
    }

    public function transaction(Request $request)
    {
        $stockIn = StockIn::with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->created_at->format('Y-m-d'),
                    'datetime' => $item->created_at->format('Y-m-d H:i:s'),
                    'type' => 'in',
                    'type_label' => 'Barang Masuk',
                    'code' => $item->product->code ?? '-',
                    'product' => $item->product->name ?? '-',
                    'qty' => $item->qty,
                    'reference' => $item->reference_no ?? '-',
                    'note' => $item->note ?? '-',
                ];
            });

        $stockOut = StockOut::with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->created_at->format('Y-m-d'),
                    'datetime' => $item->created_at->format('Y-m-d H:i:s'),
                    'type' => 'out',
                    'type_label' => 'Barang Keluar',
                    'code' => $item->product->code ?? '-',
                    'product' => $item->product->name ?? '-',
                    'qty' => $item->qty,
                    'reference' => $item->reference_no ?? '-',
                    'note' => $item->note ?? '-',
                ];
            });

        $transactions = $stockIn->merge($stockOut)
            ->sortByDesc('datetime')
            ->values();

        return view('reports.transaction', compact('transactions'));
    }
}
