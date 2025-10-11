<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PollingStation> $pollingStations
 * @property-read int|null $polling_stations_count
 *
 * @method static Builder<static>|Region newModelQuery()
 * @method static Builder<static>|Region newQuery()
 * @method static Builder<static>|Region query()
 * @method static Builder<static>|Region whereCreatedAt($value)
 * @method static Builder<static>|Region whereId($value)
 * @method static Builder<static>|Region whereName($value)
 * @method static Builder<static>|Region whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
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
