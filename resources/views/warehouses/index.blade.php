<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Warehouses</h2>
        </div>
        <div>
            <a href="/warehouses/create" class="btn btn-dash sm">
                Add Warehouse
            </a>
        </div>
    </div>
    <div class="bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paginatedWarehouses->items() as $warehouse)
                    <tr>
                        <td>{{ $warehouse->id }}</td>
                        <td>{{ $warehouse->name }}</td>
                        <td>{{ $warehouse->location }}</td>
                        <td>{{ $warehouse->user->name }}</td>
                        <td>
                            <a href="/warehouses/{{ $warehouse->id }}" class="btn btn-dash">
                                Show</a>
                            <a href="/warehouses/{{ $warehouse->id }}/edit" class="btn btn-dash">
                                Edit</a>
                            <form action="/warehouses/{{ $warehouse->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dash"
                                    onsubmit="return confirm('Are you sure you want to delete this warehouse?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-center  mt-2">
        {{ $paginatedWarehouses->onEachSide(5)->links('vendor.pagination.sample') }}
    </div>
</x-item-layout>
