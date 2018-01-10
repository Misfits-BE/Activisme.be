<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @todo Velden moeten geregistreerd worden in de DB migratie
     *
     * @var array
     */
    protected $fillable = ['telefoon_nr', 'naam', 'email', 'organisatie'];
}
