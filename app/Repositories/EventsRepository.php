<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Events;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class EventsRepository
 *
 * @package ActivismeBe\Repositories
 */
class EventsRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Events::class;
    }
}