<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">Back</a>

        <!-- Edit Shop Form -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Edit Shop</h2>

            <form method="POST" action="{{ route('shop.update', $shop->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Shop Name -->
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Shop Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $shop->name)" autofocus />
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
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $shop->address)" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
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