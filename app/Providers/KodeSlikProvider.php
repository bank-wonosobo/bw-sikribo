<?php

namespace App\Providers;

use App\Services\Impl\KodeSlikServiceImpl as ImplKodeSlikServiceImpl;
use App\Services\KodeSlikService as ServicesKodeSlikService;
use App\Services\KodeSlikServiceImpl;
use Illuminate\Support\ServiceProvider;

class KodeSlikProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ServicesKodeSlikService::class, ImplKodeSlikServiceImpl::class);
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
