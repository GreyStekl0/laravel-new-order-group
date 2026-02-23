<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Models\Region;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        if (! Gate::allows('create-region')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление категории',
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|unique:regions|max:255',
            'image' => 'required|file',
        ]);

        $file = $request->file('image');
        // Генерация уникального имени файла
        $fileName = rand(1, 100000).'_'.$file->getClientOriginalName();
        try {
            // Загрузка файла в S3
            $path = Storage::disk('s3')->putFileAs('region_pictures', $file, $fileName);
            // Получение URL загруженного файла
            $fileUrl = Storage::disk('s3')->url($path);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище S3',
            ]);
        }

        $region = new Region($validated);
        $region->picture_url = $fileUrl;
        $region->save();

        return response()->json([
            'code' => 0,
            'message' => 'Категория успешно добавлена',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region): JsonResponse
    {
        return response()->json($region);
    }
}
