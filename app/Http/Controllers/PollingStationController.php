<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollingStationRequest;
use App\Models\PollingStation;
use App\Models\Region;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PollingStationController extends Controller
{
    private const int DEFAULT_PER_PAGE = 7;

    private const int MAX_PER_PAGE = 100;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
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

        return view('polling_stations', [
            'pollingStations' => PollingStation::with('region')
                ->paginate($perPage)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('polling_station_create', [
            'regions' => Region::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PollingStationRequest $request): RedirectResponse|Redirector
    {
        $validated = $request->validated();
        $item = new PollingStation($validated);
        $item->save();

        return redirect()->route('pollingStation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $total = DB::table('polling_station_results')
            ->where('polling_station_id', $id)
            ->sum('number_of_voters');

        return view('polling_station', [
            'pollingStation' => PollingStation::findOrFail($id),
            'total' => $total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('polling_station_edit', [
            'pollingStation' => PollingStation::findOrFail($id),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PollingStationRequest $request, string $id): RedirectResponse|Redirector
    {
        $validated = $request->validated();
        $pollingStation = PollingStation::findOrFail($id);
        $pollingStation->update($validated);

        return redirect()->route('pollingStation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        if (! Gate::allows('manage-polling-stations', PollingStation::all()->where('id', $id)->first())) {
            return redirect('/error')->with('message', 'У вас нет разрешения на удаление станции для голосования номер '.$id);
        }

        PollingStation::destroy($id);

        return redirect()->route('pollingStation.index');
    }
}
