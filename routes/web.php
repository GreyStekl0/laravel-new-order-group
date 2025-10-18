<?php

use App\Http\Controllers\LoginController;
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

Route::get('/pollingstation', [PollingStationController::class, 'index'])->name('pollingStation.index');

Route::post('/pollingstation', [PollingStationController::class, 'store'])->name('pollingStation.store');

Route::get('/pollingstation/create', [PollingStationController::class, 'create'])->name('pollingStation.create');

Route::get('/pollingstation/{id}', [PollingStationController::class, 'show'])->name('pollingStation.show');

Route::get('/pollingstation/edit/{id}', [PollingStationController::class, 'edit'])->name('pollingStation.edit');

Route::patch('/pollingstation/update/{id}', [PollingStationController::class, 'update'])->name('pollingStation.update');

Route::delete('/pollingstation/destroy/{id}', [PollingStationController::class, 'destroy'])->name('pollingStation.destroy');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
