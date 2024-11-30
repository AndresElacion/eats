<x-app-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">{{ $shop->name }} - Menu</h2>
        <div class="flex space-x-6">
            <div class="w-2/3 space-y-4">
                @foreach($menuItems as $item)
                <div class="bg-white shadow-md rounded-lg p-6 flex justify-between items-center">
                    <div>
                        <h5 class="text-xl font-semibold">{{ $item->name }}</h5>
                        <p class="text-gray-600">₱{{ $item->price }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.add') }}" class="flex items-center space-x-4">
                        @csrf
                        <input type="number" name="quantity" min="1" value="1" class="w-20 px-2 py-1 border rounded-md">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Add to Cart
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            <div class="w-1/3">
                @include('customer.cart')
            </div>
        </div>
    </div>
</x-app-layout>