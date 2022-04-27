<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\User\UserSettingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Driver\DriverHomeController;
use App\Http\Controllers\User\UserPermissionController;
use App\Http\Controllers\Customer\CustomerHomeController;
use App\Http\Controllers\Customer\CustomerPasswordResetController;
use App\Http\Controllers\Driver\OrderManagementController;
use App\Http\Controllers\UtilityController;

/**
 * *********************************************
 * Public Routes
 * *********************************************
 */
Route::get("storage", function () {
    Artisan::call("storage:link");
    return "success";
});
Route::get("clear", function () {
    // Artisan::call("storage:link");
    Artisan::call("optimize:clear");
    return "success";
});

Route::controller(UtilityController::class)->group(function () {
    Route::get("send-otp", "send_otp")->name("otp.send");
    Route::get("otp-verify", "verify_otp")->name("otp.verify");
});

/**
 * Functional Routes
 * */
Route::controller(LoginController::class)->group(function () {
    // application start page
    Route::get("/", function () {
        return redirect()->route("login");
    });
    // show customer login form and perform login and logout
    Route::get("customer/register", "showCustomerRegisterForm")->name('customer.register');
    Route::post("customer/register", "showCustomerRegister")->name('customer.register.perform');
    Route::get("customer/login", "showCustomerLoginForm");
    Route::post("customer/login", "customerLogin")->name("customer.login");
    // show driver login form and perform login
    Route::get("driver/register", "showDriverRegisterForm")->name('driver.register');
    Route::post("driver/register", "showDriverRegister")->name('driver.register.perform');
    Route::get("driver/login", "showDriverLoginForm");
    Route::post("driver/login", "driverLogin")->name("driver.login");
    Route::get("driver/logout", "driverLogout")
        ->name("driver.logout")
        ->middleware("auth:driver");
});

/**
 * *********************************************
 * Back-End Routes
 * *********************************************
 */

/** Authentication Routes */
Auth::routes([
    "logout" => false,
    "register" => false,
]);

/** Routes of Admin Side with default authentication system and middleware:auth */
Route::group(["prefix" => "admin", "middleware" => "auth"], function () {
    /** Admin side dashboard, logout */
    Route::controller(HomeController::class)->group(function () {
        Route::get("home", "index")->name("home");
        Route::get("user-logout", "logout")->name("logout");
    });

    /** Admin side user management routes*/
    Route::controller(UserSettingController::class)->group(function () {
        // audit checking routes
        Route::get("user/audits/index", "auditSettings")->name("audit.index");
        Route::post("user/audits/get", "getAudits")->name("audit.get");
        // user management routes
        Route::get("user-profile/delete/{id}", "destroy")->name(
            "user-profile.destroy"
        );
        // resource routes
        Route::resource("user-profile", UserSettingController::class)->except(
            "destroy"
        );
    });
    /** Admin side access control routes */
    Route::controller(UserPermissionController::class)->group(function () {
        Route::get("permission/create/{id}", "create")->name(
            "permission.create"
        );
        Route::get("permission/delete/{id}", "destroy")->name(
            "permission.destroy"
        );
        Route::match(
            ["put", "patch"],
            "user/assigned-permissions/update/{userID}",
            "permissionUpdate"
        )->name("permission.user.update");
        // resource routes
        Route::resource("permission", UserPermissionController::class)->except(
            "destroy",
            "create"
        );
    });
    /** Admin side vehicle management routes */
    Route::controller(VehicleTypeController::class)->group(function () {
        Route::get("vehicle-type/destroy/{id}", "destroy")->name(
            "vehicle-types.destroy"
        );
        // resource routes
        Route::resource("vehicle-types", VehicleTypeController::class)->except(
            "create",
            "destroy",
            "show"
        );
    });
    /** Admin side driver management routes */
    Route::controller(DriverController::class)->group(function () {
        // get,create driver required document list
        Route::get('driver-details/required-docs', 'required_docs_index')->name('driver.document.index');
        Route::post('driver-details/required-docs/store', 'required_docs_store')->name('driver.document.store');
        Route::get('driver-details/required-docs/remove/{driverDocument}', 'required_docs_destroy')->name('driver.document.destroy');
        // approve/block driver's account
        Route::get("driver-details/change-status/{id}", "status")->name(
            "driver-details.status"
        );
        // reset driver password
        Route::get("driver/reset-password/{driver}", "reset_password")->name(
            "driver.reset.password"
        );
        // delete driver
        Route::get("driver-details/destroy/{id}", "destroy")->name(
            "driver-details.destroy"
        );
        // resource routes
        Route::resource("driver-details", DriverController::class)->except(
            "create",
            "destroy",
            "show"
        );
    });
    /** Admin side pricing management routes */
    Route::controller(PriceController::class)->group(function () {
        Route::get("price-delete/{price}", "destroy")->name("price.destroy");
        // resource routes
        Route::resource("price", PriceController::class)->except(
            "create",
            "show",
            "destroy"
        );
    });
    /** Admin side customer management Routes */
    Route::controller(CustomerController::class)->group(function () {
        // active/inactive customer account
        Route::get("customer/change-status/{id}", "status")->name(
            "customer.status"
        );
        // reset customer password
        Route::get(
            "customer/reset-password/{customer}",
            "reset_password"
        )->name("customer.reset.password");
        // delete customer
        Route::get("customer-delete/{customer}", "destroy")->name(
            "customer.destroy"
        );
        // delete agreement document under customer
        Route::get("customer-document/remove/{id}", "document_destroy")->name(
            "customer.document.destroy"
        );
        // add agreement document under customer
        Route::post("customer-document/store", "document_store")->name(
            "customer.document.store"
        );
        // resource routes
        Route::resource("customer", CustomerController::class)->except(
            "create",
            "destroy"
        );
    });
    // Customers
});

/** Routes of Customer Side with default authentication system and middleware - auth:customer */

/** Password Reset Routes */
Route::controller(CustomerPasswordResetController::class)->group(function () {
    Route::group(
        ["prefix" => "customer/password", "as" => "customer.password."],
        function () {
            Route::get("reset", "showLinkRequestForm")->name("request");
            Route::post("email", "sendResetLinkEmail")->name("email");
            Route::get("reset/{token}", "showResetForm")->name("reset");
            Route::post("reset", "reset")->name("update");
        }
    );
});
/** Protected Routes */

/** Customer Routes */
Route::group(
    ["prefix" => "customer", "middleware" => "auth:customer"],
    function () {
        // customer home controller routes
        Route::controller(CustomerHomeController::class)->group(function () {
            Route::group(["as" => "customer."], function () {
                // customer dashboard
                Route::get("home", "home")->name("home");
                // customer profile management
                Route::get(
                    "profile/edit/{customer}",
                    "customer_profile_edit"
                )->name("profile.edit");
                // customer profile update
                Route::match(
                    ["put", "patch"],
                    "profile/update/{customer}",
                    "profile_update"
                )->name("profile.update");
                // customer logout
                Route::get("logout", "customer_logout")->name("logout");
                // Price Ranges for customer
                Route::get("price-ranges/{customer}", "price_range")->name(
                    "price.range"
                );
                // customer order functionalities
                Route::controller(OrderController::class)->group(function () {
                    Route::group(
                        ["prefix" => "orders", "as" => "order."],
                        function () {
                            Route::get("new-order", "new_order")->name("new");
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
                            Route::get(
                                "booking-result",
                                "order_booking_result"
                            )->name("booking.result");
                            Route::get("all", "all_order")->name("all");
                            Route::get(
                                "details/{order}",
                                "order_details_show"
                            )->name("details.show");
                        }
                    );
                });
            });
        });
    }
);

/** Routes of Driver Side with default authentication system and middleware - auth:driver */
Route::group(
    ["prefix" => "driver", "middleware" => "auth:driver", "as" => "driver."],
    function () {
        /** Driver profile and Documents */
        Route::controller(DriverHomeController::class)->group(function () {
            Route::get('update/location', 'update_location')->name('location.update');
            Route::get('documents/list', 'documents_index')->name('document.provide.index');
            Route::post('document/upload', 'documents_store')->name('document.provide.store');
            Route::get("profile/edit/{driver}", 'driver_profile_edit')->name(
                "profile.edit"
            );
            // Driver profile update
            Route::match(
                ["put", "patch"],
                "profile/update/{driver}",
                "profile_update"
            )->name("profile.update");
            // logout
            Route::get("logout", "driver_logout")->name("logout");
        });
        /** Routes after completing the profile and document upload */
        Route::group(['middleware' => ['driver_profile', 'driver_document']], function () {
            // Driver home controller routes
            Route::controller(DriverHomeController::class)->group(function () {
                /** Home and other routes */
                Route::get("home", "home")->name("home");
            });
            // Driver Order Management Routes
            Route::controller(OrderManagementController::class)->group(function () {
                Route::group(["prefix" => "order", "as" => "order."], function () {
                    Route::get(
                        "management/{order}/handle/{value}",
                        "handle_order"
                    )->name("handle");
                    Route::get("my-orders", "my_orders")->name("mine");
                    Route::get(
                        "management/{order}/status",
                        "single_order_status"
                    )->name("status");
                    Route::get("order-map/{order}/type/{type}", "load_map")->name(
                        "map"
                    );
                    Route::get(
                        "management/{order}/update/{status}",
                        "single_order_status_update"
                    )->name("status.update");
                    Route::get(
                        "delivery-receiver-person",
                        "delivery_receiver"
                    )->name("delivery.receiver");
                });
            });
        });
    }
);
