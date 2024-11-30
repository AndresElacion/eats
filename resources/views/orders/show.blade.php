<x-app-layout>
    <div class="max-w-lg mx-auto bg-white p-4 border border-gray-300 rounded-lg shadow-lg mt-12">
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold text-gray-800">Order Receipt</h1>
            <p class="text-sm text-gray-600">Thank you for your purchase!</p>
        </div>

        <div class="mb-4">
            <p class="text-sm"><strong>Order ID:</strong> {{ $order->id }}</p>
            <p class="text-sm"><strong>Ordered by:</strong> <span class="font-semibold">{{ $order->user->name }}</span></p>
            <p class="text-sm"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p class="text-sm"><strong>Payment Status:</strong>
                <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $order->payment_status === 'paid' ? 'Paid' : 'Pending' }}
                </span>
            </p>
            <p class="text-sm"><strong>Order Status:</strong> {{ ucwords(str_replace('_', ' ', $order->status)) }}</p>
            <p class="text-sm"><strong>Total Amount:</strong> ₱ {{ number_format($order->total_amount, 2) }}</p>
        </div>

        <div class="mb-6 border-t border-gray-300 pt-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Items</h2>
            <ul class="space-y-2">
                @foreach ($order->orderItems as $item)
                    <li class="flex justify-between text-sm">
                        <span>{{ $item->item->name ?? 'Unknown Item' }}</span>
                        <span>{{ $item->quantity }} x ₱ {{ number_format($item->subtotal, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="border-t border-gray-300 pt-4 text-sm">
            <p class="font-semibold"><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
            @if($order->special_instructions)
                <p><strong>Special Instructions:</strong> {{ $order->special_instructions }}</p>
            @endif
        </div>

        @if(Auth::user()->role === 'shop')
            <!-- Update payment status -->
            <form method="POST" action="{{ route('orders.update', $order->id) }}" class="mt-4">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-2 mb-4">
                    <input type="checkbox" name="payment_status" id="payment_status" value="paid"
                        {{ $order->payment_status === 'paid' ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                        onchange="this.value = this.checked ? 'paid' : 'pending';">
                    <label for="payment_status" class="text-sm text-gray-800">Mark as Paid</label>
                </div>

                <div class="mb-4">
                    <label for="status" class="text-sm text-gray-800">Order Status</label>
                    <select name="status" id="status" class="w-full p-2 text-sm border border-gray-300 rounded">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-sm">
                    Update Payment Status
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
