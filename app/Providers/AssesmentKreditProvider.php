<?php

namespace App\Providers;

use App\Services\Impl\AssesmentKreditServiceImpl;
use App\Services\AssesmentKreditService;
use Illuminate\Support\ServiceProvider;

class AssesmentKreditProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AssesmentKreditService::class, AssesmentKreditServiceImpl::class);
    }

    public function boot() {}
}
