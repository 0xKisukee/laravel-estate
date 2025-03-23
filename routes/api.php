<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;

Route::apiResource('users', UserController::class);
Route::apiResource('properties', PropertyController::class);
