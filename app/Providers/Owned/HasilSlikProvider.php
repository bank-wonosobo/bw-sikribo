<?php

namespace App\Providers\Owned;

use App\Services\HasilSlikService;
use App\Services\Impl\HasilSlikServiceImpl;
use Illuminate\Support\ServiceProvider;

class HasilSlikProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HasilSlikService::class, HasilSlikServiceImpl::class);
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
