<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $region_id
 * @property int $stage_number
 * @property int $number_of_voters
 * @property-read Region $region
 * @property-read Collection<int, Candidate> $candidates
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read int|null $candidates_count
 *
 * @method static Builder<static>|PollingStation newModelQuery()
 * @method static Builder<static>|PollingStation newQuery()
 * @method static Builder<static>|PollingStation query()
 * @method static Builder<static>|PollingStation whereCreatedAt($value)
 * @method static Builder<static>|PollingStation whereId($value)
 * @method static Builder<static>|PollingStation whereNumberOfVoters($value)
 * @method static Builder<static>|PollingStation whereRegionId($value)
 * @method static Builder<static>|PollingStation whereStageNumber($value)
 * @method static Builder<static>|PollingStation whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PollingStation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'region_id',
        'stage_number',
        'number_of_voters',
    ];

    /**
     * @return BelongsTo<Region, $this>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return BelongsToMany<Candidate, $this>
     */
    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class, 'polling_station_results')
            ->withPivot('number_of_voters');
    }
}
