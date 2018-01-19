<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @todo Implementatie slug veld (nodig voor identificatie van de nieuwsbrief) 
 */
class NewsMailing extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array 
     */
    protected $fillable = ['author_id', 'titel', 'content', 'is_send', 'send_at', 'status'];

    /**
     * Indicator voor het bepalen welke velden datum velden zijn.
     *
     * @var array
     */
    protected $dates = ['created_at', 'send_at', 'updated_at'];

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
