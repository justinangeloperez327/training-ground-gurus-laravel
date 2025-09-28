<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold"> Show Page</h2>
        </div>
        <div>
            <a href="/items" class="btn btn-dash sm">
                Back to Items
            </a>
        </div>
    </div>
    <div class="card w-96 bg-base-100">
        <div class="card-body">
            <p class="mb-2 font-semibold">ID: {{ $item->id }}</p>
            <p class="mb-2 font-semibold">Name: {{ $item->name }}</p>
            <p class="mb-2 font-semibold">SKU: {{ $item->sku }}</p>
            <p class="mb-2 font-semibold">Reorder Level: {{ $item->reorder_level }}</p>
        </div>
    </div>
</x-item-layout>
