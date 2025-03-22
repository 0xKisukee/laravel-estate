<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;

Route::post('/users', [UserController::class, 'register']);

Route::get('/properties', [PropertyController::class, 'getAll']);
Route::post('/properties', [PropertyController::class, 'store']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);
