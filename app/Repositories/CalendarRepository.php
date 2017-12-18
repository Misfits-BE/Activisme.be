<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Calendar;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CalendarRepository
 *
 * @package ActivismeBe\Repositories
 */
class CalendarRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Calendar::class;
    }
}