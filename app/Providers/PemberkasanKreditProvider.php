<?php

namespace App\Providers;

use App\Services\Impl\PemberkasanKreditServiceImpl;
use App\Services\PemberkasanKreditService;
use Illuminate\Support\ServiceProvider;

class PemberkasanKreditProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PemberkasanKreditService::class, PemberkasanKreditServiceImpl::class);
    }

    public function boot()
    {
        //
    }
}
