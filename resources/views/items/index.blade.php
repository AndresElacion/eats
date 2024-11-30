<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Items</h1>
                <a href="{{ route('items.create') }}" 
                   class="bg-blue-600 text-white py-2 px-6 rounded-lg text-lg font-medium hover:bg-blue-700 transition duration-300">
                   Add Item
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="px-4 py-5 bg-blue-50">
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $category->name }}</h2>
                        </div>
                        <div class="px-4 py-5">
                            <ul class="space-y-3">
                                @foreach ($category->items as $item)
                                    <li class="flex justify-between items-center">
                                        <span class="text-lg font-medium text-gray-700">{{ $item->name }}</span>
                                        <span class="text-sm text-gray-500">${{ number_format($item->price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
