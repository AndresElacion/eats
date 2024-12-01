<x-app-layout>
    <div class="flex flex-col items-center justify-center">
        <div class="w-full max-w-7xl px-6 lg:px-10">
            <header class="flex justify-between items-center pt-6">
                <a href="{{ route('shop.index') }}" class="px-4 py-2 text-black ring-1 ring-transparent transition rounded-full hover:ring-red-500 hover:text-red-500 focus:outline-none">Back to Shops</a>
            </header>

            <main class="mt-4">
                <div class="mb-12 flex items-center ">
                    <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="w-22 h-48 object-cover rounded-xl hover:scale-110">
                    <h1 class="text-4xl font-extrabold text-gray-800 ml-4">{{ $shop->name }} - {{ $shop->address }}</h1>
                </div>

                <hr class="border-t-2 border-gray-300 my-4">

                <!-- Display categories in a column -->
                <div class="space-y-10 mb-12">
                    @foreach ($shop->categories as $category)
                        <div class="overflow-hidden p-6">
                            <h4 class="text-2xl font-semibold text-gray-800 mb-4 uppercase">{{ $category->name }}</h4>
                            
                            <!-- Display items within each category as a row of cards -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                                @foreach ($category->items as $item)
                                    <div class="bg-white p-2 rounded-xl border shadow-md hover:shadow-xl  text-center">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-22 h-22 object-cover rounded-md hover:scale-110">
                                        <h5 class="font-medium text-gray-800">{{ $item->name }}</h5>
                                        <p class="text-sm text-gray-600">{{ $item->description }}</p>
                                        <p class="text-lg text-red-500 font-semibold">₱{{ $item->price }}</p>
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">Add to Cart</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
