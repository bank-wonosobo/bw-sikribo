<?php

namespace App\Providers;

use App\Services\Impl\PermohonanSlikServiceImpl;
use App\Services\PermohonanSlikService;
use Illuminate\Support\ServiceProvider;

class PermohonanSlikProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PermohonanSlikService::class, PermohonanSlikServiceImpl::class);

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
