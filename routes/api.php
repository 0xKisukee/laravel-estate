<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPaymentController;
use App\Http\Controllers\Api\UserPropertyController;
use App\Http\Controllers\Api\UserTicketController;
use App\Http\Controllers\Api\TicketMessageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Auth routes
Route::middleware('auth:sanctum')->group(function () {
    // All users can log out
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('users/{user}')->group(function () {
        // All users can see their own infos
        Route::get('', [UserController::class, 'show']);
        // All users can get the list of their properties (returns a single property array for tenants)
        Route::get('properties', [UserPropertyController::class, 'index']);
        // All users can get the list of their payments
        Route::get('payments', [UserPaymentController::class, 'index']);
        // All users can get their tickets
        Route::get('tickets', [UserTicketController::class, 'index']);
    });

    Route::prefix('properties')->group(function () {
        // Owners can create a property
        Route::post('', [PropertyController::class, 'store']);
        // All users can get their property infos
        Route::get('{property}', [PropertyController::class, 'show']);

        // I DON'T KNOW WHAT TO DO WITH THESE 2 ROUTES...
        // Owners can set a tenant for a property
        Route::patch('{property}/setTenant', [PropertyController::class, 'setTenant']);
        // Owners can remove a tenant from a property
        Route::patch('{property}/removeTenant', [PropertyController::class, 'removeTenant']);
    });

    // Owners can record a payment to set it as paid
    Route::patch('payments/{payment}', [PaymentController::class, 'update']);

    // All users can get a ticket's messages
    Route::get('tickets/{ticket}/messages', [TicketMessageController::class, 'index']);
    // All users can add a message to a ticket
    Route::post('tickets/{ticket}/messages', [TicketMessageController::class, 'store']);

    // All users can create and see a ticket, Owners can update a ticket
    Route::apiResource('tickets', TicketController::class, [
        'only' => ['store', 'show', 'update']
    ]);




    // Routes to implement
    // Owners can delete a property TO DO
    // Owners can edit a property TO DO

});
