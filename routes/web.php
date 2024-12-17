<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::prefix('invoices')
        ->name('invoices.')->controller(InvoiceController::class)
        ->group(function () {

            Route::get('', 'index')->name('index');
            Route::get('{invoice}', 'show')->name('show');

            Route::middleware(['role:Admin', 'permission:create invoice'])->group(function () {
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
            });

            Route::middleware(['role:Admin|Employee', 'permission:update invoice'])->group(function () {
                Route::get('{invoice}/edit', 'edit')->name('edit');
                Route::patch('{invoice}', 'update')->name('update');
            });

            Route::middleware(['role:Admin', 'permission:delete invoice'])->group(function () {
                Route::delete('{invoice}', 'destroy')->name('destroy');
            });
        });

    Route::prefix('profile')
        ->name('profile.')->controller(ProfileController::class)
        ->group(function () {
            Route::get('', 'edit')->name('edit');
            Route::patch('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });
});


require __DIR__ . '/auth.php';
