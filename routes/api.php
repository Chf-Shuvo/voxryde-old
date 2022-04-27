<?php

use App\Http\Controllers\API\Customer\CustomerController;
use App\Http\Controllers\API\Customer\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "v1"], function () {
    /**
     * Open Routes
     */
    Route::controller(CustomerController::class)->group(function () {
        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::post('register', 'register')->name('register');
            Route::post('login', 'login')->name('login');
        });
    });

    /** 
     * Protected Routes
     */
    Route::group(['middleware' => 'auth:sanctum'], function () {
        /**
         * Customer Routes
         */
        Route::controller(CustomerController::class)->group(function () {
            Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
                Route::get('profile', 'profile')->name('profile');
                Route::get('logout', 'logout')->name('logout');
            });
        });
        /**
         * Customer Order Routes
         */
        Route::controller(OrderController::class)->group(function () {
            Route::group(['prefix' => 'customer/orders', 'as' => 'customer.order.'], function () {
                Route::get('all', 'all_order')->name('all');
                Route::post(
                    "delivery-details",
                    "get_delivery_details"
                )->name("deliver.details");
                Route::post("order-details", "order_details")->name(
                    "details"
                );
                Route::post(
                    "confirm-details",
                    "confirm_details"
                )->name("confirm");
            });
        });
    });
});
