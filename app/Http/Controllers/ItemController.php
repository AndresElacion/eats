<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $shops = Auth::user()->shops->pluck('id');
        
        // Fetch categories that belong to the authenticated user's shops
        $categories = Category::whereIn('shop_id', $shops)->get();
        
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Validate category exists
            'image' => 'nullable|image|max:2048'
        ]);

        // Ensure the category belongs to the user's shop
        $category = Category::find($validated['category_id']);
        if (!Auth::user()->shops->where('id', $category->shop_id)->exists()) {
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
}
