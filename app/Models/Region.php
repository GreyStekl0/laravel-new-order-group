<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    /**
     * @return HasMany<PollingStation, $this>
     */
    public function pollingStations(): HasMany
    {
        return $this->hasMany(PollingStation::class);
    }
}
