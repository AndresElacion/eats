<?php

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AdminOrderController;

Route::get('/', function () {
        $shops = Shop::with(['categories.items'])->get();
    return view('welcome', compact('shops'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Shop Routes
    Route::get('/shops', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/shops', [ShopController::class, 'store'])->name('shop.store');
    Route::get('shops/{shop}', [ShopController::class, 'show'])->name('shop.show');
    Route::delete('shops/{shop}', [ShopController::class, 'destroy'])->name('shop.delete');
    Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::patch('/shops/{shop}', [ShopController::class, 'update'])->name('shop.update');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'placeOrder']);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateOrderStatus']);


    Route::get('/dropdown/categories/{shopId}', function ($shopId) {
        $categories = Category::where('shop_id', $shopId)->get();
        return response()->json(['categories' => $categories]);
    });

    // Category routes
    Route::resource('categories', CategoryController::class);

    // Item routes
    Route::resource('items', ItemController::class);

    // MenuItem routes
    Route::resource('menu_items', MenuItemController::class);

    // Shop routes
    // Route::resource('shops', ShopController::class);

    // Order routes
    Route::post('orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::resource('orders', OrderController::class);

    // OrderItem routes (if needed)
    Route::resource('order-items', OrderItemController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/error', [CheckoutController::class, 'error'])->name('checkout.error');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
});

require __DIR__.'/auth.php';
