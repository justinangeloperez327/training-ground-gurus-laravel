<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginatedWarehouses = Warehouse::with('user')->paginate(5);

        return view('warehouses.index', [
            'paginatedWarehouses' => $paginatedWarehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'location' => ['required', 'string', 'max:200']
        ]);

        Warehouse::create(['user_id' => Auth::id(),...$validated]);

        return redirect('warehouses')->with('success', 'Warehouse Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        $warehouse->load('user');

        return view('warehouses.show', [
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', [
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'location' => ['required', 'string', 'max:200']
        ]);

        $warehouse->update($validated);

        return redirect('warehouses')->with('success', 'Warehouse Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect('warehouses')->with('success', 'Warehouse Deleted');
    }
}
