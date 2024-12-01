<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch categories based on the user's shops
        $shopIds = Shop::where('user_id', Auth::id())->pluck('id');
        
        $categories = Category::whereIn('shop_id', $shopIds)->get();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Fetch shops associated with the authenticated user
        $shops = Shop::where('user_id', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->get();
                     
        return view('categories.create', compact('shops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'shop_id' => 'required|exists:shops,id', // Ensure the shop_id is valid
        ]);

        Category::create([
            'name' => $validated['name'],
            'shop_id' => $validated['shop_id'],
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string',
        ]);

        // Update categories with validated data
        $category->update($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
