<?php

use App\Http\Controllers\PollingStationController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/hello', static function () {
    return view('hello', ['title' => 'hello world']);
});

Route::get('/region', [RegionController::class, 'index']);

Route::get('/region/{id}', [RegionController::class, 'show']);

Route::get('/pollingstation', [PollingStationController::class, 'index']);

Route::post('/pollingstation', [PollingStationController::class, 'store']);

Route::get('/pollingstation/create', [PollingStationController::class, 'create']);

Route::get('/pollingstation/edit/{id}', [PollingStationController::class, 'edit']);

Route::get('/pollingstation/{id}', [PollingStationController::class, 'show']);
