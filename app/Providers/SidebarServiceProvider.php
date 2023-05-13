<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('accounts.sales.layout.sidebar', function ($view) {
            $view->with('hasProduct', Product::where('user_id', auth()->user()->id)->exists());
        });
        View::composer('accounts.customer.layout.sidebar', function ($view) {
            $view->with('hasProduct', Product::where('user_id', auth()->user()->id)->exists());
        });
    }
}
