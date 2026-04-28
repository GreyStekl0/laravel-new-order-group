<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ReturnsPaginatedResponse;
use App\Http\Requests\RegionStoreRequest;
use App\Models\Region;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            Region::query()
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->orderBy('id'),
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        if (! Gate::allows('manage-regions')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на редактирование региона',
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|max:255|unique:regions,name,'.$id,
            'image' => 'nullable|file|image|max:2048',
        ]);

        try {
            $region = Region::findOrFail($id);
            $region->name = $validated['name'];

            // если передан новый файл
            if ($request->hasFile('image')) {
                try {
                    // удаление старого файла из хранилища
                    if ($region->picture_url) {
                        $baseUrl = Storage::disk('s3')->getClient()->getEndpoint();
                        $oldPath = str_replace($baseUrl, '', $region->picture_url);

                        if (Storage::disk('s3')->exists($oldPath)) {
                            Storage::disk('s3')->delete($oldPath);
                        }
                    }

                    $file = $request->file('image');
                    $fileName = rand(1, 100000).'_'.$file->getClientOriginalName();
                    $path = Storage::disk('s3')->putFileAs('category_pictures', $file, $fileName);
                    $region->picture_url = Storage::disk('s3')->url($path);
                } catch (Exception $e) {
                    return response()->json([
                        'message' => 'Error uploading file to S3: ',
                        'error' => [
                            'code' => $e->getCode(),
                            'message' => $e->getMessage(),
                        ],
                    ], 500);
                }
            }

            $region->save();

            return response()->json([
                'code' => 0,
                'message' => 'Регион успешно обновлен',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка при обновлении: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        if (! Gate::allows('manage-regions')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на удаление региона',
            ], status: 401, options: JSON_UNESCAPED_UNICODE);
        }

        $region = Region::find($id);
        if ($region->pollingStations()->count()) {
            return response()->json(['code' => 1, 'error' => 'Нельзя удалить регион, к которому привязаны участки'], options: JSON_UNESCAPED_UNICODE);
        }

        $deleted = Region::destroy($id);
        if ($deleted === 0) {
            return response()->json(['code' => 1, 'error' => 'Регион не найден'], options: JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['code' => 0, 'message' => 'Регион успешно удален'], options: JSON_UNESCAPED_UNICODE);
    }
}
