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
                        <a href="{{ route('shop.show', $shop) }}">View Details</a>
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
