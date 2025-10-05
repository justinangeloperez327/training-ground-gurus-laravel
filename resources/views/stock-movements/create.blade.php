<x-layout>
    <div class="px-4 mx-2">
        <div class="flex mb-2 justify-between">
            <div>
                <h2 class="text-2xl font-semibold">Transfer Stock</h2>
            </div>
            <div>
                <a href="{{ route('stocks.index', $stock->item_id) }}" class="btn btn-dash sm">
                    Back to Stocks
                </a>
            </div>
        </div>
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Transfer Form
                </h1>
                <form action="{{ route('stock-movements.store', $stock) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium mb-1">Item: </label>
                        <span class="text-md font-bold">
                            {{ $stock->item->name }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium mb-1">From Warehouse: </label>
                        <span class="text-md font-bold">
                            {{ $stock->warehouse->name }},
                        </span>
                        <span class="text-md font-bold">
                            {{ $stock->warehouse->location }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <label for="" class="block text-sm font-medium mb-1">Current Stock: </label>
                        <span class="text-md font-bold">
                            {{ $stock->quantity }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Select Warehouse to transfer
                        </label>
                        <select name="warehouse_id" id="warehouse_id" class="input input-md">
                            <option hidden>Please Select Warehouse to transfer</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('warehouse_id')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Quantity
                        </label>
                        <input type="number" placeholder="Quantity"
                            class="input input-md @error('quantity') input-error @enderror" name="quantity" />
                        @error('quantity')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                    </div>


                    <div class="divider">

                    </div>
                    <button type="submit" class="btn btn-primary btn-dash">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
