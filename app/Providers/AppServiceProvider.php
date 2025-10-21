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
        Paginator::defaultView('pagination::bootstrap-5');

        $abilities = [
            'manage-polling-stations',
            'manage-candidates',
            'manage-regions',
            'manage-polling-station-results',
        ];

        foreach ($abilities as $ability) {
            Gate::define($ability, static fn ($user) => $user->role === 'admin');
        }
    }
}
