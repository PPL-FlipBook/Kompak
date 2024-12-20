<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        Gate::define('admin/superadmin', function (User $user){
            return $user->role === 'admin' || $user->role === 'super admin';
        });

        Gate::define('super admin', function (User $user){
            return $user->role === 'super admin';
        });

        Gate::define('user', function (User $user){
            return $user->role === 'user';
        });
        Gate::define('admin', function (User $user){
            return $user->role === 'admin';
        });
    }
}
