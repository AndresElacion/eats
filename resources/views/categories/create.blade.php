<x-app-layout>
    <div class="container mx-auto p-6">
        <header class="flex justify-between items-center">
                <a href="{{ route('categories.index') }}" class="px-4 py-2 text-black ring-1 ring-transparent transition rounded-full hover:ring-red-500 hover:text-red-500 focus:outline-none">Back to Categories</a>
        </header>

        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Create New Category</h1>

        <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-lg font-medium text-gray-700">Category Name</label>
                <input type="text" id="name" name="name" 
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('name') }}" placeholder="Enter category name">
                @error('name')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="shop_id" class="block text-lg font-medium text-gray-700">Select Shop</label>
                <select name="shop_id" id="shop_id" 
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Select a shop</option>
                    @foreach ($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                    @endforeach
                </select>
                @error('shop_id')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-300">
                Save Category
            </button>
        </form>
    </div>
</x-app-layout>
