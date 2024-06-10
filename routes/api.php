<?php

use API\Handbooks\Controllers\AirportController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {

    Route::get('airports', [AirportController::class, 'list']);

});
