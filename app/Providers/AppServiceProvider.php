<?php

namespace App\Providers;

use Gate;
use Illuminate\Pagination\Paginator;
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
        Paginator::defaultView('pagination::default');

        Gate::define('manage-polling-stations', static function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-candidates', static function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-regions', static function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-polling-station-results', static function ($user) {
            return $user->role === 'admin';
        });
    }
}
