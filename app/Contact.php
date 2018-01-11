<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['telefoon_nr', 'naam', 'email', 'organisatie'];
}
