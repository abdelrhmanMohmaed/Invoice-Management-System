<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Customer\CustomerController;
use App\Http\Controllers\API\Invoice\InvoiceController;
use App\Http\Controllers\API\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1')
    ->controller(AuthController::class)
    ->group(function () {

        Route::post('login', 'login')->middleware('guest');
        Route::post('logout', 'logout')->middleware('auth:sanctum');



        Route::middleware(['auth:sanctum'])
            ->prefix('invoices')
            ->controller(InvoiceController::class)
            ->group(function () {

                Route::put('{invoice}', 'update')->middleware('can:update invoice');
                Route::delete('{invoice}', 'destroy')->middleware('can:delete invoice');
                Route::post('', 'store')->middleware('can:create invoice');
                Route::get('', 'index');
                Route::get('{id}', 'show');
            });

        Route::middleware(['auth:sanctum'])
            ->prefix('customers')
            ->controller(CustomerController::class)
            ->group(function () {

                Route::put('{customer}', 'update')->middleware('can:update customer');
                Route::delete('{customer}', 'destroy')->middleware('can:delete customer');
                Route::post('', 'store')->middleware('can:create customer');
                Route::get('', 'index');
                Route::get('{id}', 'show');
            });


        Route::middleware(['auth:sanctum'])
            ->prefix('users')
            ->controller(UserController::class)
            ->group(function () {

                Route::put('{user}', 'update')->middleware('can:update user');
                Route::delete('{user}', 'destroy')->middleware('can:delete user');
                Route::post('', 'store')->middleware('can:create user');
                Route::get('', 'index')->middleware('can:show user');
                Route::get('{id}', 'show')->middleware('can:show user');
            });
    });
