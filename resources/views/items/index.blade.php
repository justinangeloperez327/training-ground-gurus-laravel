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
                    <th></th>
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
                        <td class="whitespace-nowrap text-right relative">
                            @can('view', $item)
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-sm btn-dash">
                                        Actions
                                    </label>
                                    <ul tabindex="0"
                                        class="dropdown-content menu bg-base-100 rounded-box shadow z-50 w-48 absolute">
                                        <li class="block w-full">
                                            @can('view', $item)
                                                <a href="/items/{{ $item->id }}" class="text-sm">
                                                    Show</a>
                                            @endcan
                                        </li>
                                        <li class="block w-full">
                                            @can('update', $item)
                                                <a href="/items/{{ $item->id }}/edit" class="text-sm">
                                                    Edit</a>
                                            @endcan
                                        </li>
                                        <li class="block w-full">
                                            @can('delete', $item)
                                                <form action="/items/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm block w-full text-left">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </li>
                                    </ul>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-item-layout>
