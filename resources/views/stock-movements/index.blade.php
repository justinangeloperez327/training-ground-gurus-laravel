<x-item-layout>
    <div class="flex mb-2 justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Stock Movement</h2>
        </div>
    </div>
    <div class="bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Warehouse</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockMovements as $movement)
                    <tr>
                        <td>{{ $movement->item->name }}</td>
                        <td>{{ $movement->warehouse->name }}</td>
                        <td>{{ $movement->type }}</td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-item-layout>
