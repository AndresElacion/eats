<x-app-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Restaurants</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($shops as $shop)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h5 class="text-xl font-semibold mb-2">{{ $shop->name }}</h5>
                    <p class="text-gray-600 mb-4">{{ $shop->cuisine_type }}</p>
                    <a href="{{ route('shop.menu', $shop->id) }}" class="block w-full text-center bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">
                        View Menu
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>    