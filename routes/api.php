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
Route::group(['middleware' => 'auth:sanctum'], function () {
    // All users can log out
    Route::post('logout', [AuthController::class, 'logout']);
    // All users can see their own infos
    Route::get('users/{user}', [UserController::class, 'show']);
    // Owners can create a property
    Route::post('properties', [PropertyController::class, 'store']);
    // Owners can delete a property TO DO
    // Owners can edit a property TO DO
    // All users can get their property infos
    Route::get('properties/{property}', [PropertyController::class, 'show']);
    // All users can get the list of their properties (returns a single property array for tenants)
    Route::get('users/{user}/properties', [UserPropertyController::class, 'index']);
    // All users can get the list of their payments
    Route::get('users/{user}/payments', [UserPaymentController::class, 'index']);
    // Owners can record a payment to set it as paid
    Route::patch('payments/{payment}', [PaymentController::class, 'update']);
    // All users can create and see a ticket, Owners can update a ticket
    Route::apiResource('tickets', TicketController::class);
    // All users can get their tickets
    Route::get('users/{user}/tickets', [UserTicketController::class, 'index']);
    // All users can get a ticket's messages
    Route::get('tickets/{ticket}/messages', [TicketMessageController::class, 'index']);
    // All users can add a message to a ticket
    Route::post('tickets/{ticket}/messages', [TicketMessageController::class, 'store']);
    // Owners can set a tenant for a property
    Route::patch('properties/{property}/setTenant', [PropertyController::class, 'setTenant']);
    // Owners can remove a tenant from a property
    Route::patch('properties/{property}/removeTenant', [PropertyController::class, 'removeTenant']);
});
