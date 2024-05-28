<?php

namespace App\Providers\Owned;

use App\Services\DokumenHukumService;
use App\Services\Impl\DokumenHukumServiceImpl;
use Illuminate\Support\ServiceProvider;

class DokumenHukumProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DokumenHukumService::class, DokumenHukumServiceImpl::class);
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
