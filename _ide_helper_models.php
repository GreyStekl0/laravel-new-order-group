<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PollingStation> $pollingStations
 * @property-read int|null $polling_stations_count
 * @method static Builder<static>|Candidate newModelQuery()
 * @method static Builder<static>|Candidate newQuery()
 * @method static Builder<static>|Candidate query()
 * @method static Builder<static>|Candidate whereCreatedAt($value)
 * @method static Builder<static>|Candidate whereId($value)
 * @method static Builder<static>|Candidate whereName($value)
 * @method static Builder<static>|Candidate whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class Candidate extends \Eloquent {}
}

namespace App\Models{
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
 * @method static Builder<static>|PollingStation newModelQuery()
 * @method static Builder<static>|PollingStation newQuery()
 * @method static Builder<static>|PollingStation query()
 * @method static Builder<static>|PollingStation whereCreatedAt($value)
 * @method static Builder<static>|PollingStation whereId($value)
 * @method static Builder<static>|PollingStation whereNumberOfVoters($value)
 * @method static Builder<static>|PollingStation whereRegionId($value)
 * @method static Builder<static>|PollingStation whereStageNumber($value)
 * @method static Builder<static>|PollingStation whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PollingStation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PollingStation> $pollingStations
 * @property-read int|null $polling_stations_count
 * @method static Builder<static>|Region newModelQuery()
 * @method static Builder<static>|Region newQuery()
 * @method static Builder<static>|Region query()
 * @method static Builder<static>|Region whereCreatedAt($value)
 * @method static Builder<static>|Region whereId($value)
 * @method static Builder<static>|Region whereName($value)
 * @method static Builder<static>|Region whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $role
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

