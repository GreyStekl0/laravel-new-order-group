<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidateControllerApi extends Controller
{
    use ReturnsPaginatedResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->paginatedIndexResponse(
            $request,
            Candidate::query()->orderBy('id'),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate): JsonResponse
    {
        return response()->json($candidate);
    }
}
