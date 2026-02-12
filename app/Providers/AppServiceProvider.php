<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
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
