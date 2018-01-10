<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Article;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class ArticleRepository
 *
 * @package ActivismeBe\Repositories
 */
class ArticleRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }
}