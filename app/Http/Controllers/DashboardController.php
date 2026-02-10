<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $totalProducts = Product::count();

        $stockValue = Product::sum(DB::raw("stock * price"));

        $stockIn7Days = StockIn::whereDate('date', '>=', Carbon::now()->subDays(6))
            ->sum('qty');

        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')->get();
        $lowStockCount = $lowStockProducts->count();

        $labels = [];
        $stockInData = [];
        $stockOutData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $labels[] = Carbon::now()->subDays($i)->format('d M');

            $stockInData[] = StockIn::whereDate('date', $date)->sum('qty');
            $stockOutData[] = StockOut::whereDate('date', $date)->sum('qty');
        }

        return view('dashboard.index', compact(
            'title',
            'totalProducts',
            'stockValue',
            'stockIn7Days',
            'lowStockCount',
            'lowStockProducts',
            'labels',
            'stockInData',
            'stockOutData'
        ));
    }
}
