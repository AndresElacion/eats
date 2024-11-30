<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Shop;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // Display all menu items with shop and category info
    public function index()
    {
        $menuItems = MenuItem::with(['shop', 'category'])->get();
        return view('menu_items.index', compact('menuItems'));
    }

    // Show form to edit a menu item (mark as available or unavailable)
    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('menu_items.edit', compact('menuItem'));
    }

    // Update the availability status of a menu item
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_available' => 'required|boolean',
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->is_available = $request->is_available;
        $menuItem->save();

        return redirect()->route('menu_items.index')->with('success', 'Menu item availability updated.');
    }
}

