<?php

namespace App\Providers;

use App\Services\Impl\KreditServiceImpl as ImplKreditServiceImpl;
use App\Services\KreditService as ServicesKreditService;
use Illuminate\Support\ServiceProvider;
use KreditService;
use KreditServiceImpl;

class KreditProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ServicesKreditService::class, ImplKreditServiceImpl::class);
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
