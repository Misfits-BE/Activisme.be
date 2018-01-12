<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\User;
use Cog\Laravel\Ban\Models\Ban;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class UserRepository
 *
 * @package ActivismeBe\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Haal een een gebruiker op in de databank. 
     * 
     * @param  int $user Unieke waarde van de gebruiker in de databank. 
     * @return User|ModelNotFoundException
     */
    public function getUser(int $user = null): User
    {
        if (is_null($user) && auth()->check()) {
            return $this->findOrFail(auth()->user()->id);
        }

        // Er is een gebruikers id gegeven. Dus checken we of deze nog bestaat in de databank.
        // Als niet gevonden -> Throw HTTP/1 404 Not Found Response. 
        return $this->findOrFail($user);
    }

    /**
     * Blokkeer een gebruiker in het systeem/databank. 
     * 
     * @param  int $user De unieke waarde van de gebruiker in de databank. 
     * @return \Cog\Laravel\Ban\Models\Ban
     */
    public function lockUser(int $user): Ban
    {
        return $this->find($user)->ban(['expired_at' => '+2 weeks']);
    }

    /**
     * Activeer terug een gebruiker in het systeem/databank.
     * 
     * @param  int $user De unieke waarde van de gebruiker in de databank.
     * @return null|int
     */
    public function activateUser(int $user): ?int
    {
        return $this->find($user)->unban();
    }
}