<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockMovements = StockMovement::with(['warehouse', 'item', 'user'])->latest()->get();

        return view('stock-movements.index', [
            'stockMovements' => $stockMovements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Stock $stock)
    {
        $warehouses = Warehouse::where('id', '!=', $stock->warehouse_id)->get();

        return view('stock-movements.create', [
            'stock' => $stock,
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Stock $stock, Request $request)
    {
        $validated = $request->validate([
            'warehouse_id' => ['integer', 'exists:warehouses,id', 'required'],
            'quantity' => ['integer', 'required']
        ]);

        if ($stock->quantity < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => "Insufficient stock in the current warehouse"
            ])->withInput();
        }

        $stock->load('item');

        DB::transaction(function() use ($stock, $validated) {

            $item = $stock->item;

            $stock->decrement('quantity', $validated['quantity']);

            // save movement
            StockMovement::create([
                'item_id' => $stock->item_id,
                'warehouse_id' => $stock->warehouse_id,
                'type' => 'transfer-out',
                'quantity' => $validated['quantity'],
                'created_by' => Auth::id()
            ]);

            // increase to the destination warehouse
            $toStock = $item->stocks()->where('warehouse_id', $validated['warehouse_id'])->first();

            if ($toStock) {
                $toStock->increment('quantity', $validated['quantity']);
            } else {
                $item->stocks()->create([
                    'warehouse_id' => $validated['warehouse_id'],
                    'quantity' => $validated['quantity']
                ]);
            }

            // save movement
            StockMovement::create([
                'item_id' => $stock->item_id,
                'warehouse_id' => $stock->warehouse_id,
                'type' => 'transfer-in',
                'quantity' => $validated['quantity'],
                'created_by' => Auth::id()
            ]);
        });

        return redirect(route('stocks.index', $stock->item_id))->with('success', 'Transfer Success');
    }
}
