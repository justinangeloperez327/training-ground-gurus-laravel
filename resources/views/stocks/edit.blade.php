<x-layout>
    <div class="px-4 mx-2">
        <div class="flex mb-2 justify-between">
            <div>
                <h2 class="text-2xl font-semibold">Ajust Stock</h2>
            </div>
            <div>
                <a href="{{ route('stocks.index', $stock->item->id) }}" class="btn btn-dash sm">
                    Back to Stocks
                </a>
            </div>
        </div>
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Stock Form
                </h1>
                <form action="{{ route('stocks.update', $stock) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Item
                        </label>
                        <span class="text-md font-bold">
                            {{ $stock->item->name }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Warehouse
                        </label>
                        <span class="text-md font-bold">
                            {{ $stock->warehouse->name }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">
                            Quantity
                        </label>
                        <input type="number" placeholder="Quantity"
                            class="input input-md @error('quantity') input-error @enderror" name="quantity"
                            value="{{ old('quantity', $stock->quantity) }}" />
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
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
