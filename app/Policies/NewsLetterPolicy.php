<?php

namespace ActivismeBe\Policies;

use ActivismeBe\User;
use ActivismeBe\NewsMailing;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsLetterPolicy
{
    use HandlesAuthorization;

    /**
     * Check of de nieuwsbrief nog niet is verzonden.
     *
     * @param  \ActivismeBe\User         $user     (entiteit) De aangemelde gebruiker 
     * @param  \ActivismeBe\NewsMailing  $model    (entiteit) De nieuwsbrief in de databank
     * @return mixed
     */
    public function isSend(User $user, NewsMailing $model)
    {
        return $model->is_send;
    }
}
