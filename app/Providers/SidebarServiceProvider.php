<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Product;
use App\Models\User;
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
        View::composer('accounts.admin.layout.sidebar', function ($view) {
            $requestCount = User::where('password_reset', 1)->count();
            $view->with('requestCount', $requestCount);
        });
        View::composer('accounts.customer.layout.sidebar', function ($view) {
            $requestCount = Message::where('user_id', auth()->user()->id)->where('is_read', 0)->count();
            $view->with('requestCount', $requestCount);
        });
        View::composer('accounts.sales.layout.sidebar', function ($view) {
            $requestCount = Message::where('user_id', auth()->user()->id)->where('is_read', 0)->count();
            $view->with('requestCount', $requestCount);
        });
    }
}
