<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        // Fetch cart items for the authenticated user
        $cartItems = CartItem::with('item')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_address' => 'required|string|max:255',
            'special_instructions' => 'string|max:255',
            'payment_method' => 'in:gcash,cash',
            'shop_id' => 'required|exists:shops,id',
        ]);

        // Ensure user is authenticated
        $user = auth()->user();

        // Fetch cart items for the logged-in user
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            // If cart is empty, redirect to the cart with an error message
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Ensure the user has a valid shop before proceeding
        // $shop = $user->shop;
        // if (!$shop) {
        //     return redirect()->route('cart.index')->with('error', 'You must have a shop to proceed with the checkout.');
        // }

        // Start the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0, // Placeholder for the total
            'status' => 'pending', // Default status
            'shop_id' => $validatedData['shop_id'], // Use the user's shop ID
            'delivery_address' => $validatedData['delivery_address'],
            'special_instructions' => $validatedData['special_instructions'],
            'payment_method' => $validatedData['payment_method'],
        ]);

        $totalAmount = 0;

        foreach ($cartItems as $cartItem) {
            $item = $cartItem->item; // Get the related Item model

            if (!$item) {
                Log::error('CartItem missing related Item', ['cart_item_id' => $cartItem->id]);
                continue;
            }

            $subtotal = $item->price * $cartItem->quantity; // Calculate subtotal

            // Create an order item for each cart item
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $subtotal,
            ]);

            // Add to total order amount
            $totalAmount += $subtotal;
        }

        // Update order total amount
        $order->update(['total_amount' => $totalAmount]);

        // Optionally: Remove items from cart after checkout
        $cartItems->each->delete();

        // Assuming payment processing happens here and it's successful
        $paymentSuccess = true; // Change this to actual payment status after your logic

        // Check if payment was successful or failed
        if ($paymentSuccess) {
            // Redirect to the success page if the payment was successful
            return redirect()->route('checkout.success')->with('order', $order);
        } else {
            // Redirect to the error page if the payment failed
            return redirect()->route('checkout.error')->with('error', 'Payment failed.');
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function error()
    {
        return view('checkout.error');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was canceled.');
    }
}
