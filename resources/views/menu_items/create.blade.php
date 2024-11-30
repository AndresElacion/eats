<x-app-layout>
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Add New Menu Item</h1>

        <form action="{{ route('menu_items.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="shop_id" class="block text-sm font-medium">Shop</label>
                <select name="shop_id" id="shop_id" class="w-full border px-3 py-2 rounded">
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Menu Item Name</label>
                <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium">Price</label>
                <input type="number" name="price" id="price" class="w-full border px-3 py-2 rounded" required step="0.01">
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium">Category</label>
                <input type="text" name="category" id="category" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="is_available" class="block text-sm font-medium">Available</label>
                <select name="is_available" id="is_available" class="w-full border px-3 py-2 rounded" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea name="description" id="description" class="w-full border px-3 py-2 rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>