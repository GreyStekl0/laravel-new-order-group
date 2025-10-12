<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollingStationRequest;
use App\Models\PollingStation;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PollingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perpage = $request->perpage;
        // Validate perpage: must be integer between 1 and 100, else default to 7
        if (!is_numeric($perpage) || intval($perpage) < 1 || intval($perpage) > 100) {
            $perpage = 7;
        } else {
            $perpage = intval($perpage);
        }

        return view('polling_stations', [
            'pollingStations' => PollingStation::with('region')->paginate($perpage)->withQueryString(),
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
        PollingStation::destroy($id);

        return redirect()->route('pollingStation.index');
    }
}
