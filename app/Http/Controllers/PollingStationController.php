<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollingStationRequest;
use App\Models\PollingStation;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PollingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('polling_stations', [
            'pollingStations' => PollingStation::all(),
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

        return redirect('/polling_station');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $total = DB::table('polling_station_results')->selectRaw('SUM(number_of_voters) as total')->where('polling_station_id', $id)->first();

        return view('polling_station', [
            'pollingStation' => PollingStation::query()->where('id', $id)->first(),
            'total' => $total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('polling_station_edit', [
            'pollingStation' => PollingStation::query()->where('id', $id)->first(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PollingStationRequest $request, string $id): RedirectResponse|Redirector
    {
        $validated = $request->validated();
        $pollingStation = PollingStation::query()->where('id', $id)->first();
        $pollingStation->region_id = $validated['region_id'];
        $pollingStation->stage_number = $validated['stage_number'];
        $pollingStation->number_of_voters = $validated['number_of_voters'];
        $pollingStation->save();

        return redirect('/polling_station');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
