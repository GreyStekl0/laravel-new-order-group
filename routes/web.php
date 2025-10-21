<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PollingStationController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
})->name('home');

Route::get('/navigation', static function () {
    return view('navigation');
})->middleware('auth')->name('navigation');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/auth', 'authenticate')->middleware('guest')->name('auth');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::controller(RegionController::class)->prefix('region')->name('region.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show')->whereNumber('id');
    });

    Route::controller(PollingStationController::class)->prefix('pollingstation')->name('pollingStation.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show')->whereNumber('id');
        Route::get('/edit/{id}', 'edit')->name('edit')->whereNumber('id');
        Route::patch('/update/{id}', 'update')->name('update')->whereNumber('id');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy')->whereNumber('id');
    });
});
