<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candidate extends Model
{
    /**
     * @return BelongsToMany<PollingStation, $this>
     */
    public function pollingStations(): BelongsToMany
    {
        return $this->belongsToMany(PollingStation::class, 'polling_station_results');
    }
}
