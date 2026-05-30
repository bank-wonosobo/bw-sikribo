<?php

namespace App\Providers;

use App\Services\Impl\PraKomiteKreditServiceImpl;
use App\Services\PraKomiteKreditService;
use Illuminate\Support\ServiceProvider;

class PraKomiteKreditProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PraKomiteKreditService::class, PraKomiteKreditServiceImpl::class);
    }

    public function boot() {}
}
