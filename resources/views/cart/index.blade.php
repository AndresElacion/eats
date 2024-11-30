<x-app-layout>
    <div class="w-full max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-semibold text-center">Your Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <p class="text-center text-gray-500">Your cart is empty.</p>
        @else
            <div class="space-y-4">
                @foreach ($cartItems as $cartItem)
                    <div class="flex items-center justify-between p-4 bg-white shadow-md rounded">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/' . $cartItem->item->image) }}" alt="{{ $cartItem->item->name }}" class="w-16 h-16 object-cover rounded-md">
                            <div class="ml-4">
                                <h5 class="text-lg font-semibold">{{ $cartItem->item->name }}</h5>
                                <p class="text-gray-600">${{ $cartItem->item->price }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <form action="{{ route('cart.update', $cartItem) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-16 p-1 border rounded">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                            </form>
                            <form action="{{ route('cart.remove', $cartItem) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total Calculation -->
            <div class="mt-6 text-right">
                <p class="text-lg font-semibold">
                    Total: ₱ {{ $cartItems->sum(fn($cartItem) => $cartItem->item->price * $cartItem->quantity) }}
                </p>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('checkout.index') }}" class="px-6 py-3 bg-green-600 text-white rounded">Proceed to Checkout</a>
            </div>
        @endif
    </div>
</x-app-layout>
