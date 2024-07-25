<?php

use API\Access\Users\Controllers\UserController;
use API\Handbooks\Controllers\AirportController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::get('airports', [AirportController::class, 'list']);

    Route::get('users', [UserController::class, 'list']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::get('users/{id}', [UserController::class, 'find']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

});
