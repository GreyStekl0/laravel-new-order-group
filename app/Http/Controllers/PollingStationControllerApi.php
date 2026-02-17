<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Models\PollingStation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollingStationControllerApi extends Controller
{
    use ReturnsPaginatedResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->paginatedIndexResponse(
            $request,
            PollingStation::query()->orderBy('id'),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(PollingStation $pollingStation): JsonResponse
    {
        return response()->json($pollingStation);
    }
}
