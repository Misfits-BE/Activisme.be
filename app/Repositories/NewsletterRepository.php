<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Newsletter;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class NewsletterRepository
 *
 * @package ActivismeBe\Repositories
 */
class NewsletterRepository extends Repository
{

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Newsletter::class;
    }
}