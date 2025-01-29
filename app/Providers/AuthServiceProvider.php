<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\MenuPolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // ...existing code...
        User::class => MenuPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
        // ...existing code...
    }
}
