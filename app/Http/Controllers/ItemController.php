<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::query()
            ->orderBy('name')
            ->get();

        return view('items.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255'],
            'reorder_level' => ['required', 'integer'],
        ]);

        // old way
        // $item = new Item();
        // $item->name = $validated['name'];
        // $item->sku = $validated['sku'];
        // $item->reorder_level = $validated['reorder_level'];
        // $item->save();

        // fancy way
        Item::create($validated);

        return redirect('/items')->with('success', 'Item created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255'],
            'reorder_level' => ['required', 'integer'],
        ]);

        // old way update
        // $item->name = $validated['name'];
        // $item->sku = $validated['sku'];
        // $item->reorder_level = $validated['reorder_level'];
        // $item->save();

        //fancy way
        $item->update($validated);

        return redirect('/items')->with('success', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/items')->with('success', 'Item deleted');
    }
}
