<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>

        <!-- Edit Item Form -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Edit Item</h2>

            <form method="POST" action="{{ route('items.update', $item->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Item Name</label>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $item->name)" autofocus />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $item->price)" autofocus />
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-3 py-2 border rounded-lg @error('category_id') border-red-500 @enderror" >
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
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

                <!-- Submit Button -->
                <div class="mt-8">
                    <x-primary-button class="w-full">
                        {{ __('Update Shop') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>