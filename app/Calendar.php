<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Database model voor de evenement datums. 
 * 
 * De reden waarom er alleen datums in deze databank tabel worden opgeslagen. 
 * Omdat elke datum meerde evenementen kunnen hebben. Vandaar ook de 1 op meerdere 
 * Relatie (events). Alle event data word daar opgeslagen. 
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class Calendar extends Model
{
    /**
     * Mass-assign velden voor de databank table.
     *
     * @var array
     */
    protected $fillable = ['start_date'];

    /**
     * Cast de datum velden als een 'date'object
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    /**
     * Data relatie om de evenementen per dattum op te halen. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Events::class)
            ->withTimestamps();
    }
}
