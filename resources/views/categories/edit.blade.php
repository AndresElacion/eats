<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>

        <!-- Edit Category Form -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Edit Category</h2>

            <form method="POST" action="{{ route('categories.update', $category->id)}}">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category Name -->
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Category Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <x-primary-button class="w-full">
                        {{ __('Update Category') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>