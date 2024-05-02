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
use App\Http\Controllers\SlikController;
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
    // return AuthUser::user();
    return redirect()->route('admin.dashboard.index');
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
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


    Route::prefix('kredit')
        ->as('kredit.')
        ->controller(KreditController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/file', 'file')->name('file');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::get('/{id}/delete', 'delete')->name('delete');

        });

    Route::prefix('kategori-kredit')
        ->as('kategori-kredit.')
        ->controller(KategoriKreditController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });

    Route::prefix('slik')
        ->as('slik.')
        ->controller(SlikController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::get('/monthlydestroy', 'monthlydestroy')->name('monthlydestroy');
        });
});
