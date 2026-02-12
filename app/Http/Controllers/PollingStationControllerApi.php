<?php

namespace App\Http\Controllers;

use App\Models\PollingStation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollingStationControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(PollingStation::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PollingStation $pollingStation): JsonResponse
    {
        return response()->json($pollingStation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
