<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\User;
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

    public function lockUser(int $user): void  
    {

    }
}