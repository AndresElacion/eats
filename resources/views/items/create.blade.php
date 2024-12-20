<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Create New Item</h1>

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Item Name</label>
                <input type="text" name="name" id="name" 
                    class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror" 
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" name="price" id="price" step="0.01" 
                    class="w-full px-3 py-2 border rounded-lg @error('price') border-red-500 @enderror" 
                    value="{{ old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="shop_id" class="block text-gray-700 font-bold mb-2">Shop</label>
                <select name="shop_id" id="shop_id" 
                        class="w-full px-3 py-2 border rounded-lg @error('shop_id') border-red-500 @enderror" 
                        required>
                    <option value="">Select a Shop</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}" 
                                {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
                            {{ $shop->name }}
                        </option>
                    @endforeach
                </select>
                @error('shop_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category_id" id="category_id" 
                        class="w-full px-3 py-2 border rounded-lg @error('category_id') border-red-500 @enderror" 
                        required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Item Image</label>
                <input type="file" name="image" id="image" 
                    class="w-full px-3 py-2 border rounded-lg @error('image') border-red-500 @enderror" 
                    accept="image/*">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Create Item
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('shop_id').addEventListener('change', function() {
            let shopId = this.value;

            // Clear current categories
            let categorySelect = document.getElementById('category_id');
            categorySelect.innerHTML = '<option value="">Select a Category</option>';

            if (shopId) {
                // Make AJAX request to fetch categories for the selected shop
                fetch(`/dropdown/categories/${shopId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate categories dropdown
                        data.categories.forEach(category => {
                            let option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            categorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching categories:', error));
            }
        });
    </script>
</x-app-layout>
