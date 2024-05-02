<?php

namespace App\Providers;

use App\Services\Impl\SlikServiceImpl;
use App\Services\SlikService;
use Illuminate\Support\ServiceProvider;

class SlikProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SlikService::class, SlikServiceImpl::class);
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
