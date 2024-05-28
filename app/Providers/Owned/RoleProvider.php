<?php

namespace App\Providers\Owned;

use App\Repositories\Impl\RoleRepositoryImpl;
use App\Repositories\RoleRepository;
use App\Services\Impl\RoleServiceImpl;
use App\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class RoleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RoleRepository::class, RoleRepositoryImpl::class);
        $this->app->singleton(RoleService::class, function ($app) {
            return new RoleServiceImpl();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
