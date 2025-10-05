<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Item: {{ $item->name }}</h2>
        </div>
        <div>
            <a href="{{ route('stocks.create', $item->id) }}" class="btn btn-dash sm">
                Add Stock
            </a>
        </div>
    </div>
    <div class="bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>Warehouse</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->stocks as $stock)
                    <tr>
                        <td>{{ $stock->warehouse->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td class="whitespace-nowrap text-right relative">
                            <div class="dropdown dropdown-end">
                                <label tabindex="0" class="btn btn-sm btn-dash">
                                    Actions
                                </label>
                                <ul tabindex="0"
                                    class="dropdown-content menu bg-base-100 rounded-box shadow z-50 w-48 absolute">
                                    <li class="block w-full">
                                        <a href="{{ route('stocks.edit', $stock) }}" class="text-sm">
                                            Adjust</a>
                                    </li>
                                    <li class="block w-full">
                                        <a href="{{ route('stock-movements.create', $stock) }}" class="text-sm">
                                            Transfer</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-item-layout>
