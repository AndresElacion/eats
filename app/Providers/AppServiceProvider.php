<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('cartCount', CartItem::where('user_id', auth()->id())->sum('quantity'));
        });
    }
}
