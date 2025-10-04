<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalItems = Cache::rememberForever('items_count', function () {
            return Item::count();
        });

        $totalWarehouses = Warehouse::count();

        return view('dashboard', [
            'totalItems' => $totalItems,
            'totalWarehouses' => $totalWarehouses,
        ]);
    }
}
