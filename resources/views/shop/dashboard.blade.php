<x-app-layout>
    <div class="flex space-x-6 p-6">
        <div class="w-1/3 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">Add Menu Item</h3>
            <form method="POST" action="{{ route('shop.menu.add') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Item Name</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Price</label>
                    <input type="number" step="0.01" name="price" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">
                    Add Item
                </button>
            </form>
        </div>
        <div class="w-2/3 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">Your Menu Items</h3>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuItems as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $item->name }}</td>
                        <td class="p-3">₱{{ $item->price }}</td>
                        <td class="p-3">
                            <a href="{{ route('shop.menu.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>