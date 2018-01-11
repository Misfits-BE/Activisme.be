<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

/**
 * Databnak model voor de ondersteuners an Activisme_BE 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten 
 */
class Backer extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'street_name', 'huis_nr', 'postal_code', 'city'];
}
