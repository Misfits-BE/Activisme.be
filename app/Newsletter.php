<?php

namespace ActivismeBe;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /**
     * Mass-assign velden voor de databank tabel.
     *
     * @var array
     */
    protected $fillable = ['email'];
}
