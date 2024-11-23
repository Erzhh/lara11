<?php

use API\Access\Users\Controllers\UserController;
use API\Advert\Controllers\AdvertController;
use API\Handbooks\Controllers\AirportController;
use API\Movies\Controllers\MovieGetController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::get('airports', [AirportController::class, 'list']);

    Route::get('users', [UserController::class, 'list']);
    Route::get('users/list/limited/{page}/{limit}', [UserController::class, 'paginate']);

    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::get('users/{id}', [UserController::class, 'find']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::get('movies/list', [MovieGetController::class, 'list']);
    Route::get('movies/elastic', [MovieGetController::class, 'elastic']);

    Route::post('advert', [AdvertController::class, 'store']);
    Route::get('advert', [AdvertController::class, 'list']);
    Route::get('advert/{id}', [AdvertController::class, 'findById']);
    Route::delete('advert/{id}', [AdvertController::class, 'deleteById']);
    Route::put('advert/{id}', [AdvertController::class, 'update']);

});
