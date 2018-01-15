<?php

namespace ActivismeBe\Policies;

use ActivismeBe\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BanPolicy
{
    use HandlesAuthorization;

    /**
     * Check of de gebruiker niet de zelfde is dan gegeven. 
     * --- 
     * GEBRUIK: Bij de blokkering en activerings methodes in de user-management console. 
     *
     * @param  \ActivismeBe\User  $user     (entiteit) De aangemelde gebruiker 
     * @param  \ActivismeBe\User  $model    (entiteit) De gebruiker in de databank
     * @return mixed
     */
    public function authUser(User $user, User $model)
    {
        return $user->id !== $model->id;
    }
}
