<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'warehouses' => $warehouses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Item $item, StoreStockRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($item, $validated): void {
            $item->stocks()->create($validated);

            StockMovement::create([
                'item_id' => $item->id,
                'warehouse_id' => $validated['warehouse_id'],
                'type' => 'add',
                'quantity' => $validated['quantity'],
                'created_by' => Auth::id(),
            ]);
        });

        return redirect(route('stocks.index', $item->id))->with('success', 'Stocks Added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', [
            'stock' => $stock,
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

        if ($stock->quantity < $validated['quantity']) {
            $type = 'increase';
            $quantity = $validated['quantity'] - $stock->quantity;
        } else {
            $type = 'decrease';
            $quantity = $stock->quantity - $validated['quantity'];
        }

        DB::transaction(function () use ($stock, $quantity, $validated, $type): void {
            StockMovement::create([
                'item_id' => $stock->item_id,
                'warehouse_id' => $stock->warehouse_id,
                'type' => $type,
                'quantity' => $quantity,
                'created_by' => Auth::id(),
            ]);

            $stock->update([
                'quantity' => $validated['quantity'],
            ]);
        });

        return redirect(route('stocks.index', $stock->item->id))->with('success', 'Stocks Updated');
    }
}
