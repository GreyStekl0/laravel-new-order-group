<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PollingStation> $pollingStations
 * @property-read int|null $polling_stations_count
 *
 * @method static Builder<static>|Candidate newModelQuery()
 * @method static Builder<static>|Candidate newQuery()
 * @method static Builder<static>|Candidate query()
 * @method static Builder<static>|Candidate whereCreatedAt($value)
 * @method static Builder<static>|Candidate whereId($value)
 * @method static Builder<static>|Candidate whereName($value)
 * @method static Builder<static>|Candidate whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Candidate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany<PollingStation, $this>
     */
    public function pollingStations(): BelongsToMany
    {
        return $this->belongsToMany(PollingStation::class, 'polling_station_results');
    }
}
