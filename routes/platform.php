<?php

declare(strict_types=1);

use App\Orchid\Screens\Movies\ListScreen;
use App\Orchid\Screens\PlatformScreen;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

Route::screen('/movies', ListScreen::class)
    ->name('platform.movies.list');

Route::screen('/adverts', \App\Orchid\Screens\Adverts\ListScreen::class)
    ->name('platform.adverts.list');
