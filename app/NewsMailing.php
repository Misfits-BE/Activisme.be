<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @todo registratie publicatie_datum 
 * @todo (bool field) 'gepubliceerd' - Nodig voor de publicatie of klad status te bepalen.
 * @todo Implementatie slug veld (nodig voor identificatie van de nieuwsbrief) 
 */
class NewsMailing extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array 
     */
    protected $fillable = ['author_id', 'titel', 'content', 'is_send', 'status'];

    /**
     * Data relatie voor de autheur van de nieuwsbrief. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault([
            'name' => 'Onbekende gebruiker', 'email' => 'noreply@activisme.be'
        ]);
    }
}
