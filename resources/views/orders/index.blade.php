<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-800">My Orders</h1>

        @if($orders->isEmpty())
            <div class="bg-gray-50 p-6 rounded-lg text-center shadow-md">
                <p class="text-gray-500 text-lg">You haven't placed any orders yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between border border-gray-200">
                        <!-- Left Side: Order Details -->
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-gray-800">
                                Order #{{ $order->id }} 
                                <span class="text-sm font-medium text-gray-500">| {{ ucwords(str_replace('_', ' ', $order->status)) }}</span>
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">
                                Placed on {{ $order->created_at->format('F d, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                Ordered by: <span class="font-medium text-gray-800">{{ $order->user->name }}</span>
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                Delivery Address: <span class="font-medium text-gray-800">{{ $order->delivery_address }}</span>
                            </p>
                            @if($order->special_instructions)
                                <p class="text-sm text-gray-600 mt-1">
                                    Special Instructions: <span class="font-medium">{{ $order->special_instructions }}</span>
                                </p>
                            @endif
                        </div>

                        <!-- Right Side: Order Summary -->
                        <div class="border-t border-gray-200 pt-4">
                            <p class="text-2xl font-bold text-green-600">
                                ₱{{ number_format($order->total_amount, 2) }}
                            </p>
                            <p class="text-sm text-gray-600 mt-2">
                                Payment Method: <span class="uppercase font-semibold">{{ $order->payment_method }}</span>
                            </p>
                            <p class="text-sm text-gray-600">
                                Payment Status: 
                                <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $order->payment_status === 'paid' ? 'Paid' : 'Pending' }}
                                </span>
                            </p>
                            <a href="{{ route('orders.show', $order) }}" 
                               class="inline-block mt-4 text-sm font-medium text-blue-600 hover:text-blue-800">
                                View Order Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
