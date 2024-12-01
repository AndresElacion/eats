<x-app-layout>
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Menu Items</h1>

        <a href="{{ route('menu_items.create') }}" class="btn btn-primary mb-4">Add New Menu Item</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Category</th>
                    <th class="border px-4 py-2">Shop</th>
                    <th class="border px-4 py-2">Availability</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItems as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->name }}</td>
                        <td class="border px-4 py-2">₱{{ number_format($item->price, 2) }}</td>
                        <td class="border px-4 py-2">{{ $item->category }}</td>
                        <td class="border px-4 py-2">{{ $item->shop->name }}</td>
                        <td class="border px-4 py-2">{{ $item->is_available ? 'Available' : 'Unavailable' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('menu_items.edit', $item->id) }}" class="text-blue-500">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>