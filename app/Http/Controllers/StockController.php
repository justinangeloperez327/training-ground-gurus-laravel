<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        // lazy loading
        $item = $item->load('stocks.warehouse');

        return view('stocks.index', [
            'item' => $item,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Item $item)
    {
        $warehousesWithStocks = Stock::where('item_id', $item->id)->pluck('warehouse_id');

        // $warehouses = Auth::user()->warehouses()->whereNotIn('id', $warehousesWithStocks);

        $warehouses = Warehouse::whereNotIn('id', $warehousesWithStocks)->where('user_id', Auth::id())->get();
        return view('stocks.create', [
            'item' => $item,
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Item $item, StoreStockRequest $request)
    {
        $item->stocks()->create($request->validated());

        return redirect(route('stocks.index', $item->id))->with('success', 'Stocks Added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', [
            'stock' => $stock
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        $validated = $request->validated();

        if ($stock->quantity == $validated['quantity']) {
            return back()->with('info', 'No changes made to the stock quantiy');
        }

        $stock->update([
            'quantity' => $validated['quantity']
        ]);

        return redirect(route('stocks.index', $stock->item->id))->with('success', 'Stocks Updated');
    }
}
