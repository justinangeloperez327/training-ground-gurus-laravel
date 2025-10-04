<x-layout>
    <div class="px-4 mx-2">
        <div class="flex mb-2 justify-between">
            <div>
                <h2 class="text-2xl font-semibold">Add New Stocks</h2>
            </div>
            <div>
                <a href="{{ route('stocks.index', $item) }}" class="btn btn-dash sm">
                    Back to Stocks
                </a>
            </div>
        </div>
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Stock Form
                </h1>
                <form action="{{ route('stocks.store', $item) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Select Warehouse
                        </label>
                        <select name="warehouse_id" id="warehouse_id" class="input input-md">
                            <option hidden>Please Select Warehouse</option>
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
