<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Fetch orders with user relationship
        $orders = Order::with('user') // Ensure 'user' relation exists
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Fetch specific order with items and user
        $order->load('orderItems.item', 'user'); // Ensure these relations exist

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Validate the status input
        $validated = $request->validate([
            'status' => 'required|in:confirmed,out_for_delivery,delivered,cancelled'
        ]);

        // Update the order status
        $order->update(['status' => $validated['status']]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }
}
