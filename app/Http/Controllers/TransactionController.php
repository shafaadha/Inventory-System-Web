<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $title = 'Transaksi Barang';

        $stockIns = StockIn::with('product')->latest()->get();
        $stockOuts = StockOut::with('product')->latest()->get();

        return view('transaction.index', compact(
            'title',
            'stockIns',
            'stockOuts'
        ));
    }
}
