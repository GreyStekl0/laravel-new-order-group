<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionControllerApi extends Controller
{
    use ReturnsPaginatedResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->paginatedIndexResponse(
            $request,
            Region::query()->orderBy('id'),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region): JsonResponse
    {
        return response()->json($region);
    }
}
