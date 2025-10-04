<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        // sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $reorder_level = $request->reorder_level;

        $paginatedItems = Item::query()
            ->with('user')
            ->withSum('stocks as total_stocks', 'quantity')

            ->when($search, function($query) use ($search) {
                $query->whereAny([
                    'name', 'sku', 'reorder_level'
                ], 'LIKE', '%'.$search.'%');
            })
            ->when($sort === 'id' || $sort === 'reorder_level', function ($query) use ($sort, $direction) {
                $query->orderBy($sort, $direction);
            }, function ($query) use ($sort, $direction) {
                $query->orderByRaw("LOWER({$sort}) {$direction}");
            })
            ->when($reorder_level, function ($query) use ($reorder_level) {
                $query->where('reorder_level', '<=', $reorder_level);
            })
            ->paginate(10)
            ->withQueryString();

        return view('items.index', [
            'paginatedItems' => $paginatedItems,
            'sort' => $sort,
            'direction' => $direction,
            'reorder_level' => $reorder_level
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

        Cache::forget('items_count');

        Cache::rememberForever('items_count', function () {
            return Item::count();
        });

        return redirect('/items')->with('success', 'Item created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        Gate::authorize('view', $item);
        $item->load('user');

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

        Cache::forget('items_count');

        Cache::rememberForever('items_count', function () {
            return Item::count();
        });

        return redirect('/items')->with('success', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Gate::authorize('delete', $item);

        $item->delete();

        Cache::forget('items_count');

        Cache::rememberForever('items_count', function () {
            return Item::count();
        });

        return redirect('/items')->with('success', 'Item deleted');
    }
}
