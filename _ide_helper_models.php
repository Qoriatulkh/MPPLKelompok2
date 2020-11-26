<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Area
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 */
	class Area extends \Eloquent {}
}

namespace App{
/**
 * App\Paralegal
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Paralegal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paralegal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paralegal query()
 */
	class Paralegal extends \Eloquent {}
}

namespace App{
/**
 * App\ParalegalCase
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCase query()
 */
	class ParalegalCase extends \Eloquent {}
}

namespace App{
/**
 * App\ParalegalCaseField
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseField query()
 */
	class ParalegalCaseField extends \Eloquent {}
}

namespace App{
/**
 * App\ParalegalCaseType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParalegalCaseType query()
 */
	class ParalegalCaseType extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

