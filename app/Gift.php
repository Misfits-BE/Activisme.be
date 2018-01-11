<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

/**
 * Databank model voor de donaties
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class Gift extends Model
{
    /**
     * Mass-assign velpden voor de database tabel.
     *
     * @var array
     */
    protected $fillable = ['backer_id', 'amount', 'transaction_id', 'status', 'processed', 'uuid'];
}
