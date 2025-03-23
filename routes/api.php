<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TicketController;

Route::apiResource('users', UserController::class);
Route::apiResource('properties', PropertyController::class);
Route::apiResource('tickets', TicketController::class);

// Owners can get the list of their properties
Route::get('users/{user}/properties', [UserController::class, 'getOwnerProperties']);

// Tenants can get their property infos
Route::get('users/{user}/property', [UserController::class, 'getTenantProperty']);

// Owners and tenants can get the list of their payments
Route::get('users/{user}/payments', [UserController::class, 'getPayments']);

// Owners can record a payment to set it as paid
Route::patch('payments/{payment}/recordPayment', [PaymentController::class, 'recordPayment']);

// Owners can set a tenant for their property
Route::patch('properties/{property}/setTenant/{user}', [PropertyController::class, 'setTenant']);

// Owners can set a tenant for their property
Route::patch('properties/{property}/removeTenant', [PropertyController::class, 'removeTenant']);

// Owners and tenants can get their tickets
Route::get('user/{user}/tickets', [TicketController::class, 'getTickets']);

// Get messages route

// Add message route
