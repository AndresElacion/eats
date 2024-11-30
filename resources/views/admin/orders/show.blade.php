<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>

            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" 
                        class="form-select border rounded px-2 py-1">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Order Details</h2>
                <div class="space-y-2">
                    <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Total Price:</strong> ₱{{ $order->total_amount }}</p>
                    <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                    @if($order->special_instructions)
                        <p><strong>Special Instructions:</strong> {{ $order->special_instructions }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                <div class="space-y-3">
                    @foreach($order->orderItems as $orderItem)
                        <div class="flex justify-between items-center border-b pb-2">
                            <div>
                                <p class="font-medium">{{ $orderItem->item->name }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $orderItem->quantity }} × ₱{{ $orderItem->item->price }}
                                </p>
                            </div>
                            <p class="font-bold">
                                ₱{{ number_format($orderItem->quantity * $orderItem->item->price, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
