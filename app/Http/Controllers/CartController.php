<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class CartController extends Controller
{
    // Show the user's cart
    public function index()
    {
        // Retrieve the cart items from the database for the authenticated user
        $cartItems = CartItem::with('item') // Eager load item relationship
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Add an item to the cart
    public function add(Item $item)
    {
        // Check if the item already exists in the cart for the user
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('item_id', $item->id)
            ->first();

        if ($cartItem) {
            // Increment the quantity if the item exists
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Create a new cart item
            CartItem::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function getCartCount()
    {
        return CartItem::where('user_id', auth()->id()->sum('quantity'));
    }

    // Remove an item from the cart
    public function remove(CartItem $cartItem)
    {
        // Ensure the user is authorized to delete this cart item
        if ($cartItem->user_id === auth()->id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    // Update item quantity in the cart
    public function update(Request $request, CartItem $cartItem)
    {
        // Ensure the user is authorized to update this cart item
        if ($cartItem->user_id === auth()->id()) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }
}
