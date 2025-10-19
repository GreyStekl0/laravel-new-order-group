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

Route::get('/region', [RegionController::class, 'index'])->name('region.index')->middleware('auth');

Route::get('/region/{id}', [RegionController::class, 'show'])->name('region.show')->middleware('auth');

Route::get('/pollingstation', [PollingStationController::class, 'index'])->name('pollingStation.index')->middleware('auth');

Route::post('/pollingstation', [PollingStationController::class, 'store'])->name('pollingStation.store')->middleware('auth');

Route::get('/pollingstation/create', [PollingStationController::class, 'create'])->name('pollingStation.create')->middleware('auth');

Route::get('/pollingstation/{id}', [PollingStationController::class, 'show'])->name('pollingStation.show')->middleware('auth');

Route::get('/pollingstation/edit/{id}', [PollingStationController::class, 'edit'])->name('pollingStation.edit')->middleware('auth');

Route::patch('/pollingstation/update/{id}', [PollingStationController::class, 'update'])->name('pollingStation.update')->middleware('auth');

Route::delete('/pollingstation/destroy/{id}', [PollingStationController::class, 'destroy'])->name('pollingStation.destroy')->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');

Route::get('/error', static function () {
    return view('error', ['message' => session('message')]);
})->name('error');
