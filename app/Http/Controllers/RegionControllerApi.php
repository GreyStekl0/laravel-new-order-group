<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Http\Requests\RegionStoreRequest;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

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
     * Store a newly created resource in storage.
     */
    public function store(RegionStoreRequest $request): JsonResponse
    {
        $disk = Storage::disk('s3');
        $filePath = null;
        $validated = $request->validated();

        try {
            $filePath = $disk->putFile('region_pictures', $validated['image']);

            if (! is_string($filePath)) {
                throw new RuntimeException('Failed to upload region image to S3.');
            }

            $region = Region::create([
                'name' => $validated['name'],
                'picture_url' => $disk->url($filePath),
            ]);
        } catch (Throwable $exception) {
            if (is_string($filePath)) {
                $disk->delete($filePath);
            }

            report($exception);

            return response()->json([
                'message' => 'Не удалось создать категорию.',
            ], 500);
        }

        return response()->json($region, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region): JsonResponse
    {
        return response()->json($region);
    }
}
