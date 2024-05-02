<?php

namespace App\Providers;

use App\Helper\AuthUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Gate::define('kredit:manage', function ($user = null) {
            $user = AuthUser::user();
            $roles = $this->getArrPermissions($user);
            // dd($user);
            return in_array('bw:archive:kredit:manage', $roles) ;
        });

        Gate::define('kategorikredit:manage', function ($user = null) {
            $user = AuthUser::user();
            $roles = $this->getArrPermissions($user);
            // dd($user);
            return in_array('bw:archive:kategorikredit:manage', $roles) ;
        });

        Gate::define('slik:manage', function ($user = null) {
            $user = AuthUser::user();
            $roles = $this->getArrPermissions($user);
            // dd($user);
            return in_array('bw:archive:slik:manage', $roles) ;
        });
    }

    public function getArrRoles($user)
    {
        $roles = [];
        foreach ($user->roles as $value) {
            $roles[] = $value;
        }

        return $roles;
    }

    public function getArrPermissions($user)
    {
        $permissions = [];
        foreach ($user->permissions as $value) {
            $permissions[] = $value;
        }

        return $permissions;
    }
}
