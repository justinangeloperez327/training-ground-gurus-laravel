<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Edit Item</h2>
        </div>
        <div>
            <a href="/items" class="btn btn-dash sm">
                Back to Items
            </a>
        </div>
    </div>
    <div class="card w-96 bg-base-100">
        <div class="card-body">
            <h1 class="mt-1 text-lg font-bold mb-6">
                Item Form
            </h1>
            <form action="/items/{{ $item->id }}" method="POST">
                @csrf
                @method('PUT')
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Name" class="input input-md @error('name') input-error @enderror"
                        name="name" value="{{ $item->name }}" />
                    <span>Name</span>
                </label>
                @error('name')
                    <div class="label -mt-4 mb-2">
                        <span class="label-text-alt text-error">
                            {{ $message }}
                        </span>
                    </div>
                @enderror
                <label class="floating-label mb-6">
                    <input type="text" placeholder="SKU" class="input input-md @error('sku') input-error @enderror"
                        name="sku" value="{{ $item->sku }}" />
                    <span>SKU</span>
                </label>
                @error('sku')
                    <div class="label -mt-4 mb-2">
                        <span class="label-text-alt text-error">
                            {{ $message }}
                        </span>
                    </div>
                @enderror
                <label class="floating-label mb-6">
                    <input type="number" min="0" placeholder="Reorder Level"
                        class="input input-md @error('reorder_level') input-error @enderror" name="reorder_level"
                        value="{{ $item->reorder_level }}" />
                    <span>Reorder Level</span>
                </label>
                @error('reorder_level')
                    <div class="label -mt-4 mb-2">
                        <span class="label-text-alt text-error">
                            {{ $message }}
                        </span>
                    </div>
                @enderror
                <div class="divider">

                </div>
                <button type="submit" class="btn btn-primary btn-dash">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-item-layout>
