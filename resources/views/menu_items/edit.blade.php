<x-app-layout>
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Edit Menu Item</h1>

        <form action="{{ route('menu_items.update', $menuItem->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="is_available" class="block text-sm font-medium text-gray-700">Availability</label>
                <select name="is_available" id="is_available" class="mt-1 block w-full">
                    <option value="1" {{ $menuItem->is_available ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$menuItem->is_available ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Availability</button>
        </form>
    </div>
</x-app-layout>    