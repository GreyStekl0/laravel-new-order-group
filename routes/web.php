<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/hello', static function () {
    return view('hello', ['title' => 'hello world']);
});
