<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

        // if (Auth::user()->role == 'admin') {
        //     $items = Item::query()
        //         ->orderBy('name')
        //         ->get();
        // }

        return view('items.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Item::class);

        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Item::class);

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
        // $item->user_id = Auth::id();
        // $item->save();

        // fancy way
        // Item::create([
        //     'name' => $validated['name'],
        //     'sku' => $validated['sku'],
        //     'reorder_level' => $validated['reorder_level'],
        //     'user_id' => Auth::id(),
        // ]);

        // another fancy way
        Item::create(['user_id' => Auth::id(), ...$validated]);

        // easy way
        // Auth::user()->items()->create($validated);

        return redirect('/items')->with('success', 'Item created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        Gate::authorize('view', $item);

        return view('items.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        Gate::authorize('update', $item);

        return view('items.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        Gate::authorize('update', $item);

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
        Gate::authorize('delete', $item);

        $item->delete();

        return redirect('/items')->with('success', 'Item deleted');
    }
}
