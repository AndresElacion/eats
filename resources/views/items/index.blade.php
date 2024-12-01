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
                                        <span class="text-sm text-gray-500">₱ {{ number_format($item->price, 2) }}</span>
                                        <a href="{{ route('items.edit', $item->id) }}" class="flex items-center text-gray-500 hover:text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.621 18.092a4.5 4.5 0 01-1.682 1.057l-4.135 1.378 1.378-4.135a4.5 4.5 0 011.057-1.682l11.242-11.243z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.006 7.168L16.832 4.994" />
                                            </svg>
                                            Edit Details
                                        </a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 flex items-center"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
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
