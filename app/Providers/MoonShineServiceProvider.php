<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use App\MoonShine\Resources\UserResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                UserResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ]);
    }
}
