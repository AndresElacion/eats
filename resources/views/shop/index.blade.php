<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">Active Shops</h1>
        </div>

        <!-- Success Message -->
        @if(session('message'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <!-- Display Shops -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if($shops->isEmpty())
                <p class="text-lg text-gray-500 col-span-full">No active shops available. Please add a shop to get started.</p>
            @else
                @foreach($shops as $shop)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $shop->name }}</h3>
                        <p class="text-sm text-gray-600 italic mt-1">{{ $shop->cuisine_type }}</p>
                        <p class="text-sm text-gray-500 mt-2"><strong>Address:</strong> {{ $shop->address }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('shop.edit', $shop->id) }}" class="flex items-center text-gray-500 hover:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.621 18.092a4.5 4.5 0 01-1.682 1.057l-4.135 1.378 1.378-4.135a4.5 4.5 0 011.057-1.682l11.242-11.243z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.006 7.168L16.832 4.994" />
                                </svg>
                                Edit Details
                            </a>
                            <a href="{{ route('shop.show', $shop) }}" class="flex items-center text-gray-500 hover:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.858-.678 1.666-1.198 2.392C17.268 16.057 13.477 19 9 19c-4.477 0-8.268-2.943-9.542-7.007a12.042 12.042 0 01-.075-.993z" />
                                </svg>
                                View Details
                            </a>
                            <form action="{{ route('shop.delete', $shop->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 flex items-center"
                                        onclick="return confirm('Are you sure you want to delete this shop?')">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Add a New Shop Form -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Add a New Shop</h2>

            <form method="POST" action="{{ route('shop.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Shop Name -->
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Shop Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" :value="__('Shop Image')"/>
                        <input type="file" name="image" id="image" 
                            class="w-full px-3 py-1 mt-1 @error('image') border-red-500 @enderror" 
                            accept="image/*">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <x-primary-button class="w-full">
                        {{ __('Create Shop') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
