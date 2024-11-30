<x-app-layout>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-100 p-4 font-semibold">Your Cart</div>
        <div class="p-6">
            @foreach($cart as $item)
            <div class="flex justify-between mb-2 pb-2 border-b">
                <span>{{ $item->name }}</span>
                <span>₱{{ $item->price * $item->quantity }}</span>
            </div>
            @endforeach
            <div class="mt-4 text-right">
                <strong class="text-xl">Total: ₱{{ $total }}</strong>
                <form method="POST" action="{{ route('order.place') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>