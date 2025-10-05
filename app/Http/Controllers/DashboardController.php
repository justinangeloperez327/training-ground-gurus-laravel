<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\CustomerUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalItems = Cache::rememberForever('items_count', function () {
            return Item::count();
        });

        $totalWarehouses = Warehouse::count();

        $lowStockItems = Item::query()
            ->join('stocks', 'stocks.item_id', '=', 'items.id')
            ->selectRaw('items.id, SUM(stocks.quantity) as total_stock, items.reorder_level')
            ->groupBy('items.id', 'items.reorder_level')
            ->havingRaw('SUM(stocks.quantity) <= items.reorder_level')
            ->count();

        return view('dashboard', [
            'totalItems' => $totalItems,
            'totalWarehouses' => $totalWarehouses,
            'lowStockItems' => $lowStockItems
        ]);
    }
}
