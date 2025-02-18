<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

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
        if (!app()->isLocal()) {
            View::cache();
        }
        
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        // Cache expensive queries
        DB::enableQueryLog();
        
        // Add global scope for soft deletes performance
        Builder::macro('withTrashed', function () {
            return $this->withoutGlobalScope(SoftDeletingScope::class);
        });

        // Cache configuration settings
        Config::set('cache.ttl', env('CACHE_TTL', 3600));

        Blade::component('layouts.guest-error', 'guest-error-layout');
    }
}
