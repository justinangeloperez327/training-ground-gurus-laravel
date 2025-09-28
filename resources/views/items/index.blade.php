<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Items</h2>
        </div>
        <div>
            <a href="/items/create" class="btn btn-dash sm">
                Add Item
            </a>
        </div>
    </div>
    <div class="bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Reorder Level</th>
                    <th>Total Stocks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['sku'] }}</td>
                        <td>{{ $item['reorder_level'] }}</td>
                        <td>{{ $item['total_stock'] }}</td>
                        <td>
                            <a href="/items/{{ $item->id }}" class="btn btn-dash">
                                Show</a>
                            <a href="/items/{{ $item->id }}/edit" class="btn btn-dash">
                                Edit</a>
                            <form action="/items/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dash">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-item-layout>
