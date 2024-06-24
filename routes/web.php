<?php

use App\Helper\AuthUser;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\FileArchiveController;
use App\Http\Controllers\HasilSlikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingMailController;
use App\Http\Controllers\JenisDokumenHukumController;
use App\Http\Controllers\JenisJaminanController;
use App\Http\Controllers\KategoriKreditController;
use App\Http\Controllers\KodeSlikController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\OutgoingMailController;
use App\Http\Controllers\PermohonanSlikController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    middleware('auth')
    ->get('/', function () {
    // return AuthUser::user();
    return redirect()->route('admin.dashboard.index');
});

Route::prefix('admin')
->middleware('auth')
->as('admin.')
->group(function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


    Route::controller(UserController::class)
    ->middleware('auth')
    ->prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::post('/', 'store')->name('store');
        Route::post('/{id}/generate-password', 'generatePassword')->name('generate-password');
        Route::post('/{id}/change-password', 'changePassword')->name('change-password');
        Route::post('/{id}/create-password', 'createPassword')->name('create-password');
        Route::delete('/{id}', 'delete')->name('delete');
        Route::post('/send-credential', 'sendCredential')->name('send-credential');
        Route::get('/{id}', 'detail')->name('detail');
    });

    Route::controller(RoleController::class)
        ->prefix('roles')
        ->middleware('auth')
        ->as('roles.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::post('/permission', 'add_permission')->name('add-permission');
            Route::post('/permission/{role_id}/grant', 'grant_permission')->name('grant-permission');
        });


    Route::prefix('kredit')
        ->as('kredit.')
        ->controller(KreditController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
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

    Route::prefix('hasil-slik')
        ->as('hasil-slik.')
        ->controller(HasilSlikController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::get('/monthlydestroy', 'monthlydestroy')->name('monthlydestroy');
        });

    Route::prefix('kode-slik')
        ->as('kode-slik.')
        ->controller(KodeSlikController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/set', 'setCode')->name('set');
        });

    Route::prefix('permohonan-slik')
        ->as('permohonan-slik.')
        ->controller(PermohonanSlikController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/detail', 'detail')->name('detail');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/history', 'history')->name('history');
        });

    Route::prefix('slik')
        ->as('slik.')
        ->controller(SlikController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create/{permohonan_slik_id}', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/done', 'done')->name('done');
            Route::get('/{id}/start-slik', 'startSlik')->name('start-slik');
        });

    Route::prefix('jenis-dh')
        ->as('jenis-dh.')
        ->controller(JenisDokumenHukumController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });

    Route::prefix('dokumen-hukum')
        ->as('dokumen-hukum.')
        ->controller(DokumenHukumController::class)
        ->group(function() {
            Route::get('/{jdh_id}/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    Route::prefix('jenis-jaminan')
        ->as('jenis-jaminan.')
        ->controller(JenisJaminanController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('kirim-email','App\Http\Controllers\MailController@index');
