<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Message;
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

    public function boot()
    {
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $unreadCount = Message::unread(Auth::id())->count();
            $view->with('unreadMessages', $unreadCount);
        }
    });
}
}
