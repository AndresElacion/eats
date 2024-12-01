<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        // Get all shops associated with the authenticated user
        $shopIds = Auth::user()->shops->pluck('id'); // Assuming relationship is set on User model

        // Fetch categories that belong to the user's shops and include the items in those categories
        $categories = Category::whereIn('shop_id', $shopIds)->with('items')->get();
        
        return view('items.index', compact('categories'));
    }

    public function create()
    {
        // Get all shops associated with the authenticated user
        $shops = Auth::user()->shops;

        // Fetch categories that belong to the authenticated user's shops
        $categories = Category::whereIn('shop_id', $shops->pluck('id'))->get();
        
        return view('items.create', compact('categories', 'shops'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Validate category exists
            'image' => 'nullable|image|max:2048',
            'shop_id' => 'required|exists:shops,id',
        ]);

        // Ensure the category belongs to the user's shop
        $category = Category::find($validated['category_id']);
        if (!Auth::user()->shops->where('id', $category->shop_id)) {
            return redirect()->back()->with('error', 'You are not authorized to add items to this category.');
        }

        // Store image if it exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $validated['image'] = $imagePath;
        }

        // Create the item for the validated category
        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    public function edit(Item $item)
    {
        // Get all shops associated with the authenticated user
        $shopIds = Auth::user()->shops->pluck('id'); // Assuming relationship is set on User model

        // Fetch categories that belong to the user's shops and include the items in those categories
        $categories = Category::whereIn('shop_id', $shopIds)->with('items')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id', // Validate category exists
            'image' => 'nullable|image|max:2048'
        ]);

        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($item->image && Storage::exists('public/' . $item->image)) {
                Storage::delete('public/' . $item->image);
            }

            // Store the new image in the 'shops' directory within 'storage/app/public'
            $imagePath = $request->file('image')->store('shops', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update items with validated data
        $item->update($validatedData);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
