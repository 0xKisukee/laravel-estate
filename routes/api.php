<?php

use App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Auth routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    // All users can log out
    Route::post('logout', [AuthController::class, 'logout']);
    // All users can see their own infos
    Route::get('users/{user}', [UserController::class, 'show']);
    // All users can get their property infos
    Route::get('properties/{property}', [PropertyController::class, 'show']);
    // All users can get the list of their payments
    Route::get('users/{user}/payments', [UserController::class, 'getPayments']);
    // Owners and tenants can get their tickets
    Route::get('user/{user}/tickets', [TicketController::class, 'getTickets']);
    // Get messages route
    Route::get('tickets/{ticket}/messages', [MessageController::class, 'getMessages']);
    // Add message route
    Route::post('tickets/{ticket}/newMessage', [MessageController::class, 'newMsg']);

    Route::group(['middleware' => 'is_owner'], function () {
        // Owners can create a property
        Route::post('properties', [PropertyController::class, 'store']);
        // Owners can delete a property
        // TO DO
        // Owners can edit a property
        // TO DO
        // Owners can get the list of their properties
        Route::get('users/{user}/properties', [UserController::class, 'getOwnerProperties']);
        // Owners can record a payment to set it as paid
        Route::patch('payments/{payment}/recordPayment', [PaymentController::class, 'recordPayment']);
        // Owners can set a tenant for a property
        Route::patch('properties/{property}/setTenant/{user}', [PropertyController::class, 'setTenant']);
        // Owners can remove a tenant from a property
        Route::patch('properties/{property}/removeTenant', [PropertyController::class, 'removeTenant']);
        // Owners can update a ticket's status
        Route::patch('tickets/{ticket}', [PropertyController::class, 'update']);
    });

    Route::group(['middleware' => 'is_tenant'], function () {
        // Tenants can get their property infos
        Route::get('users/{user}/property', [UserController::class, 'getTenantProperty']);
    });

    // All users can create and see a ticket
    Route::apiResource('tickets', TicketController::class);
});
