<x-app-layout>
    <div class="w-full max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-semibold text-center">Checkout</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
                {{ session('error') }}
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
                                <p class="text-gray-600">Quantity: {{ $cartItem->quantity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-6 text-right">
                    <p class="text-lg font-semibold">
                        Total: ${{ $cartItems->sum(fn($cartItem) => $cartItem->item->price * $cartItem->quantity) }}
                    </p>
                </div>
            </div>

            <div class="mt-6 text-left">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <!-- Hidden field for shop_id -->
                    <input type="hidden" name="shop_id" value="{{ $cartItems->first()->item->shop_id }}" />
                    
                    <div class="mb-6">
                        <label for="delivery_address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                        <textarea id="delivery_address" name="delivery_address" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="special_instructions" class="block text-sm font-medium text-gray-700">Special Instructions</label>
                        <textarea id="special_instructions" name="special_instructions" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="cash" selected>Cash on Delivery</option>
                        </select>
                    </div>

                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
