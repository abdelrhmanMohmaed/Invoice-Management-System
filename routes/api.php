<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Invoice\InvoiceController;
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

                Route::get('', 'index');
                Route::post('', 'store')->middleware('can:create invoice');
                Route::put('{invoice}', 'update')->middleware('can:update invoice');
                Route::delete('{invoice}', 'destroy')->middleware('can:delete invoice');
            });

    });
