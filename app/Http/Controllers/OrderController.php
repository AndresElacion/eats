<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Item;
use App\Models\Order;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'customer') {
            // For customers, show their own orders
            $orders = Order::where('user_id', Auth::id())->get();
        } elseif ($user->role == 'shop') {
            // For shop owners, show orders for their shop
            $shopIds = Auth::user()->shops->pluck('id');
            $orders = Order::whereIn('shop_id', $shopIds)->orderBy('created_at', 'desc')->get();
        } else {
            // If the role is not recognized, abort or handle as needed
            abort(403, 'Unauthorized access');
        }

        return view('orders.index', compact('orders'));
    }
    
    public function placeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'items' => 'required|array',
            'payment_method' => 'in:gcash,cash',
        ]);

        $totalAmount = 0;
        $orderItems = [];

        foreach ($validatedData['items'] as $item) {
            $itemModel = Item::find($item['item_id']);

            if (!$itemModel) {
                continue; // Skip invalid items
            }

            $subtotal = $itemModel->price * $item['quantity'];
            $totalAmount += $subtotal;

            $orderItems[] = [
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
            ];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'shop_id' => $validatedData['shop_id'],
            'total_amount' => $totalAmount,
            'payment_method' => $validatedData['payment_method'] ?? 'gcash',
            'status' => 'pending',
        ]);

        if (!empty($orderItems)) {
            $order->orderItems()->createMany($orderItems);
        }

        return response()->json($order, 201);
    }


    public function updateOrderStatus(Request $request, Order $order)
    {
        $user = Auth::user();

        // Check if the logged-in user is the shop owner for the order
        if ($user->role == 'shop' && $order->shop_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $validatedData = $request->validate([
            'status' => 'in:confirmed,out_for_delivery,delivered,cancelled',
        ]);

        $order->update(['status' => $validatedData['status']]);

        return response()->json($order);
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Ensure the 'payment_status' is one of the enum values
        $validatedData = $request->validate([
            'payment_status' => 'in:pending,paid,failed',  // Enum validation
            'status' => 'in:pending,confirmed,out_for_delivery,delivered,cancelled'
        ]);

        $order->update($validatedData);

        return back()->with(['message' => 'Payment status updated successfully.']);
    }


}
