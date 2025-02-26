<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\UsersResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                UserResource::class,
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                UsersResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ]);
    }
}
