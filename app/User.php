<?php

namespace ActivismeBe;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

/**
 * Databank model voor de gebruikers 
 * 
 * @author      Tim Joosten <tim@activisme.be> 
 * @copyright   2018 Tim Joosten 
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
