<?php

use App\Helper\AuthUser;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileArchiveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingMailController;
use App\Http\Controllers\KategoriKreditController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\OutgoingMailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::
    middleware('oauth')
    ->get('/', function () {
    return AuthUser::user();
    // return redirect()->route('auth.login');
});

Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/callback', 'callback')->name('callback');
    });



Route::prefix('admin')
->middleware('oauth')
->as('admin.')
->group(function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

    Route::prefix('kredit')
        ->as('kredit.')
        ->controller(KreditController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/file', 'file')->name('file');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::patch('/{id}', 'update')->name('update');
        });

    Route::prefix('kategori-kredit')
        ->as('kategori-kredit.')
        ->controller(KategoriKreditController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });
});
