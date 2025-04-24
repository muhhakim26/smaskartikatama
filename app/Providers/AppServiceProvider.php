<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
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
        // RateLimiter::for('login', function (Request $request) {
        //     // return Limit::perMinute(3)->by($request->input('surel'));
        // });
        Gate::define('isSuperAdmin', function (Admin $admin) {
            return $admin->level === 'superadmin';
        });
    }
}