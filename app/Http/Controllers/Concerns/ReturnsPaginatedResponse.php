<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ReturnsPaginatedResponse
{
    protected function paginatedIndexResponse(
        Request $request,
        Builder $query,
        int $defaultPerPage = 15,
        int $maxPerPage = 100,
    ): JsonResponse {
        $validated = $request->validate([
            'perpage' => ['sometimes', 'integer', 'min:1', 'max:' . $maxPerPage],
            'page' => ['sometimes', 'integer', 'min:1'],
        ]);

        $perPage = (int) ($validated['perpage'] ?? $defaultPerPage);

        return response()->json(
            $query->paginate($perPage)->withQueryString(),
        );
    }
}
