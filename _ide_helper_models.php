<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace ActivismeBe{
/**
 * Het databank model voor de artikel categorieen.
 *
 * @author Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 * @property int $id
 * @property int|null $author_id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBe\Article[] $articles
 * @property-read \ActivismeBe\User|null $author
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * ActivismeBe\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User role($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * ActivismeBe\Events
 *
 * @property int $id
 * @property int $author_id
 * @property string $name
 * @property string $status
 * @property string $start_time
 * @property string $end_time
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \ActivismeBe\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBe\Calendar[] $dates
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Events whereUpdatedAt($value)
 */
	class Events extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * ActivismeBe\Contact
 *
 */
	class Contact extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * Database model voor de evenement datums.
 * 
 * De reden waarom er alleen datums in deze databank tabel worden opgeslagen.
 * Omdat elke datum meerde evenementen kunnen hebben. Vandaar ook de 1 op meerdere
 * Relatie (events). Alle event data word daar opgeslagen.
 *
 * @author Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 * @property int $id
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBe\Events[] $events
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Calendar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Calendar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Calendar whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Calendar whereUpdatedAt($value)
 */
	class Calendar extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * ActivismeBe\Gift
 *
 * @property int $id
 * @property string $uuid
 * @property string $processed
 * @property int $backer_id
 * @property string $transaction_id
 * @property string $amount
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereBackerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Gift whereUuid($value)
 */
	class Gift extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * ActivismeBe\Backer
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $street_name
 * @property string $huis_nr
 * @property string $postal_code
 * @property string $city
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereHuisNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Backer whereUpdatedAt($value)
 */
	class Backer extends \Eloquent {}
}

namespace ActivismeBe{
/**
 * Het artikel databank model.
 *
 * @author Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 * @property int $id
 * @property int $author_id
 * @property string $is_published
 * @property string $slug
 * @property string $title
 * @property string $message
 * @property \Carbon\Carbon $publish_date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \ActivismeBe\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\ActivismeBe\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ActivismeBe\Article whereUpdatedAt($value)
 */
	class Article extends \Eloquent {}
}

