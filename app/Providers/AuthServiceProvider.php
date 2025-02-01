<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\MenuPolicy;
use App\Models\Resumo;
use App\Policies\ResumoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Resumo::class => ResumoPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-admin-items', [MenuPolicy::class, 'viewAdminItems']);
        Gate::define('view-tcc-items', [MenuPolicy::class, 'viewTccItems']);
        Gate::define('view-resumo-items', [MenuPolicy::class, 'viewResumoItems']);
    }
}
