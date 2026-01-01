<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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
        Model::unguard();

        Gate::define('accessFilament', function ($user) {
            return $user->is_admin; // Hanya admin yang bisa masuk
        });

        // Paksa HTTPS jika di Production (Vercel)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
