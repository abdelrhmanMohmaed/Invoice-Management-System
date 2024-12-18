<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\CustomerController;
use App\Http\Controllers\Website\InvoiceController;
use App\Http\Controllers\Website\UserController;
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

            Route::middleware(['role:Admin|Employee', 'permission:update invoice'])->group(function () {
                Route::get('{invoice}/edit', 'edit')->name('edit');
                Route::patch('{invoice}', 'update')->name('update');
            });

            Route::middleware(['permission:delete invoice'])->group(function () {
                Route::delete('{invoice}', 'destroy')->name('destroy');
            });
            Route::middleware(['permission:create invoice'])->group(function () {
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
            });

            Route::get('', 'index')->name('index');
            Route::get('{invoice}', 'show')->name('show');
        });


    Route::prefix('customers')
        ->name('customers.')->controller(CustomerController::class)
        ->middleware(['permission:show customer|create customer|update customer|delete customer'])
        ->group(function () {

            Route::get('{customer}/edit', 'edit')->name('edit');
            Route::patch('{customer}', 'update')->name('update');


            Route::delete('{customer}', 'destroy')->name('destroy');

            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');

            Route::get('', 'index')->name('index');
            Route::get('{customer}', 'show')->name('show');
        });

    Route::prefix('users')
        ->name('users.')->controller(UserController::class)
        ->middleware(['permission:show user|create user|update user|delete user'])
        ->group(function () {

            Route::get('{user}/edit', 'edit')->name('edit');
            Route::patch('{user}', 'update')->name('update');


            Route::delete('{user}', 'destroy')->name('destroy');

            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');

            Route::get('', 'index')->name('index');
            Route::get('{user}', 'show')->name('show');
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
