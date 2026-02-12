<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateControllerApi;
use App\Http\Controllers\PollingStationControllerApi;
use App\Http\Controllers\RegionControllerApi;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/PollingStation', [PollingStationControllerApi::class, 'index']);
    Route::get('/PollingStation/{pollingStation}', [PollingStationControllerApi::class, 'show']);

    Route::get('/Candidate', [CandidateControllerApi::class, 'index']);
    Route::get('/Candidate/{candidate}', [CandidateControllerApi::class, 'show']);

    Route::get('/Region', [RegionControllerApi::class, 'index']);
    Route::get('/Region/{region}', [RegionControllerApi::class, 'show']);
});
