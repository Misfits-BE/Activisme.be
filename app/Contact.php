<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

/**
 * Databank model voor de contact personen in het systeem. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 */
class Contact extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['telefoon_nr', 'naam', 'email', 'organisatie'];
}
