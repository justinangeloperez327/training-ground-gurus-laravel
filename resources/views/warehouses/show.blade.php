<x-layout>
    <div class="px-4 mx-2">
        <div class="flex mb-2 justify-between">
            <div>
                <h2 class="text-2xl font-semibold"> Show Page</h2>
            </div>
            <div>
                <a href="/warehouses" class="btn btn-dash sm">
                    Back to Warehouses
                </a>
            </div>
        </div>
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <p class="mb-2 font-semibold">ID: {{ $warehouse->id }}</p>
                <p class="mb-2 font-semibold">Name: {{ $warehouse->name }}</p>
                <p class="mb-2 font-semibold">Location: {{ $warehouse->location }}</p>
                <p class="mb-2 font-semibold">Created By: {{ $warehouse->user->name }}</p>
            </div>
        </div>
    </div>
</x-layout>
