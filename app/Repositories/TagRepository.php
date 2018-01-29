<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Tag;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class TagRepository
 *
 * @package ActivismeBe\Repositories
 */
class TagRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }
}