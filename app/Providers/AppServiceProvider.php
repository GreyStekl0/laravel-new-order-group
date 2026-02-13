<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('login', static function (Request $request): Limit {
            return Limit::perMinute(5)->by(strtolower((string) $request->input('email')).'|'.$request->ip());
        });

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
