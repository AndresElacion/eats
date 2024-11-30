<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Show all active shops
    public function index()
    {
        // Get only the active shops created by the authenticated user
        $shops = Shop::where('user_id', auth()->id())
                     ->where('is_active', true)
                     ->get();

        // Return the view and pass the shops data
        return view('shop.index', compact('shops'));
    }

    // Store a newly created shop
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Store image if it exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shops', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create a new shop with the validated data
        Shop::create([
            'user_id' => auth()->id(),
            ...$validatedData
        ]);

        // Redirect back to the shop index with a success message
        return redirect()->route('shop.index')->with('message', 'Shop created successfully!');
    }

    // Show a specific shop's details
    public function show(Shop $shop)
    {
        // Return the view to show the shop details and pass the shop instance
        return view('shop.show', compact('shop'));
    }
}
