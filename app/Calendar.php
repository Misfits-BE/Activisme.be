<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * Mass-assign velden voor de databank table.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date'];

    /**
     * Cast de datum velden als een 'date'object
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    public function events()
    {

    }
}
