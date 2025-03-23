<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;

Route::apiResource('users', UserController::class);
Route::apiResource('properties', PropertyController::class);

Route::get('users/{user}/properties', [UserController::class, 'getOwnerProperties']);
Route::get('users/{user}/property', [UserController::class, 'getTenantProperty']);

Route::get('users/{user}/payments', [UserController::class, 'getPayments']);
