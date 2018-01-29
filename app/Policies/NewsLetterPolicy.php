<?php

namespace ActivismeBe\Policies;

use ActivismeBe\User;
use ActivismeBe\NewsMailing;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Permissie en authorizatie check voor de nieuwsbrieven.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \ActivsmeBe\Policies
 */
class NewsLetterPolicy
{
    use HandlesAuthorization;

    /**
     * Check of de nieuwsbrief nog niet is verzonden.
     *
     * @param  \ActivismeBe\User         $user     (entiteit) De aangemelde gebruiker 
     * @param  \ActivismeBe\NewsMailing  $model    (entiteit) De nieuwsbrief in de databank
     * @return bool
     */
    public function isSend(User $user, NewsMailing $model): bool
    {
        return $model->is_send;
    }
}
