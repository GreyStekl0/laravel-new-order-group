<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateControllerApi;
use App\Http\Controllers\PollingStationControllerApi;
use App\Http\Controllers\RegionControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', static function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);

    Route::get('/pollingstation', [PollingStationControllerApi::class, 'index']);
    Route::get('/pollingstation/{pollingStation}', [PollingStationControllerApi::class, 'show']);

    Route::get('/candidate', [CandidateControllerApi::class, 'index']);
    Route::get('/candidate/{candidate}', [CandidateControllerApi::class, 'show']);
    Route::get('/candidates_total', [CandidateControllerApi::class, 'total']);

    Route::get('/region', [RegionControllerApi::class, 'index']);
    Route::get('/region/{region}', [RegionControllerApi::class, 'show']);
});
