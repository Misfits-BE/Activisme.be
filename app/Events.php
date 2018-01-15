<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Databank model voor de evenementen. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 */
class Events extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = ['author_id', 'status', 'name', 'start_time', 'end_time'];

    /**
     * Data relatie voor de gegevens van de autheur.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'verwijdere gebruiker']);
    }

    /**
     * Haal de datum op geassocieerd met het evenement. 
     *
     * @return BelongsToMany
     */
    public function dates(): BelongsToMany
    {
        return $this->belongsToMany(Calendar::class)->withTimestamps();
    }
}
