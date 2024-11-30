<x-app-layout>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-bold mb-4">Create Order</h2>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Delivery Address</label>
                    <input type="text" name="delivery_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Special Instructions (Optional)</label>
                    <textarea name="special_instructions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Select Items</h3>
                    @foreach($categories as $category)
                        <div class="mb-4">
                            <h4 class="font-medium">{{ $category->name }}</h4>
                            @foreach($category->items as $item)
                                <div class="flex items-center mb-2">
                                    <input type="number" 
                                           name="items[{{ $item->id }}][quantity]" 
                                           min="0" 
                                           placeholder="Qty" 
                                           class="w-20 mr-2 rounded-md border-gray-300">
                                    <input type="hidden" 
                                           name="items[{{ $item->id }}][item_id]" 
                                           value="{{ $item->id }}">
                                    <span>{{ $item->name }} - ${{ number_format($item->price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                    Place Order (Cash on Delivery)
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>