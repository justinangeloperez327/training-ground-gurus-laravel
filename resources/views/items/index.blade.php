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
    <div class="flex">
        <form action="{{ route('items.index') }}" method="GET">
            <div class="flex gap-2">
                <div class="">
                    <label class="floating-label mb-6">
                        <input type="text" placeholder="Search" class="input input-md" name="search"
                            value="{{ request('search') }}" />
                        <span>Search</span>
                    </label>
                </div>
                <div class="">
                    <label class="floating-label mb-6">
                        <select class="input input-md" name="reorder_level" id="reorder_level">
                            <option value="10" @if ($reorder_level == 10) selected @endif>10</option>
                            <option value="100" @if ($reorder_level == 100) selected @endif>100</option>
                            <option value="200" @if ($reorder_level == 200) selected @endif>200</option>
                            <option value="500" @if ($reorder_level == 500) selected @endif>500</option>
                        </select>
                        <span>Reorder Level</span>
                    </label>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="bg-base-100">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <a
                            href="{{ route('items.index', [
                                'search' => request('search'),
                                'sort' => 'id',
                                'direction' => $sort == 'id' && $direction == 'asc' ? 'desc' : 'asc',
                            ]) }}">
                            ID
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('items.index', [
                                'search' => request('search'),
                                'sort' => 'name',
                                'direction' => $sort == 'name' && $direction == 'asc' ? 'desc' : 'asc',
                            ]) }}">
                            Name
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('items.index', [
                                'search' => request('search'),
                                'sort' => 'sku',
                                'direction' => $sort == 'sku' && $direction == 'asc' ? 'desc' : 'asc',
                            ]) }}">
                            SKU
                        </a>
                    </th>
                    <th>
                        <a
                            href="{{ route('items.index', [
                                'search' => request('search'),
                                'sort' => 'reorder_level',
                                'direction' => $sort == 'reorder_level' && $direction == 'asc' ? 'desc' : 'asc',
                            ]) }}">
                            Reorder Level
                        </a>
                    </th>
                    <th>Total Stocks</th>
                    <th>Created By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paginatedItems->items() as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>{{ $item->sku }}</td>
                        <td>{{ $item->reorder_level }}</td>
                        <td>{{ $item->total_stocks }}</td>
                        <td>{{ $item->user->name }}</td>
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
                                                <form action="/items/{{ $item->id }}" method="POST" class="block w-full"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-sm block w-full text-left cursor-pointer">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </li>
                                        <li class="block w-full">

                                            <a href="{{ route('stocks.index', $item) }}" class="text-sm">
                                                Stocks
                                            </a>

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
    <div class="flex justify-center  mt-2">
        {{ $paginatedItems->onEachSide(5)->links('vendor.pagination.sample') }}
    </div>
</x-item-layout>
