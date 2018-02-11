<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Het databank model voor de artikel categorieen. 
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class Tag extends Model
{
    use HasSlug;

    /**
     * De mass-assign velden voor de databank tabel. 
     */
    protected $fillable = ['author_id', 'name', 'slug', 'description'];

    /**
     * De array met standaard waarde voor de description. 
     *
     * @todo Kijk of men bij de creatie van het label 'author_id' niet kan zetten
     *       Naar de aangemelde gebruiker op dat moment. 
     * 
     * @var array
     */
    protected $attributes = [
        'description' => 'Er is geen beschrijving gegeven voor de categorie',
        'author_id'   => '0'
    ];

    /**
     * Relatie om de nieuws artikelen per tag op te halen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * Autheurs data relatie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '<span class="text-danger">' . config('app.name') . '</span>'
        ]);
    }

    /**
     * Slug configuratie voor de categorie.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }
}
