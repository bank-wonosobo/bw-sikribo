<?php

namespace App\Providers;

use App\Services\Impl\KomiteKreditServiceImpl;
use App\Services\KomiteKreditService;
use Illuminate\Support\ServiceProvider;

class KomiteKreditProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(KomiteKreditService::class, KomiteKreditServiceImpl::class);
    }

    public function boot() {}
}
