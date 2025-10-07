<?php

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
