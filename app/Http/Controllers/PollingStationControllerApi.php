<?php

namespace App\Http\Controllers;

use App\Models\PollingStation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollingStationControllerApi extends Controller
{
    private const int DEFAULT_PER_PAGE = 5;

    private const int MAX_PER_PAGE = 100;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = filter_var(
            $request->query('perpage', self::DEFAULT_PER_PAGE),
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'default' => self::DEFAULT_PER_PAGE,
                    'min_range' => 1,
                    'max_range' => self::MAX_PER_PAGE,
                ],
            ],
        );

        $page = filter_var(
            $request->query('page', 0),
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'default' => 0,
                    'min_range' => 0,
                ],
            ],
        );

        return response()->json(
            PollingStation::query()
                ->orderBy('id')
                ->limit($perPage)
                ->offset($perPage * $page)
                ->get(),
        );
    }

    public function total(): JsonResponse
    {
        return response()->json(PollingStation::query()->count());
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
