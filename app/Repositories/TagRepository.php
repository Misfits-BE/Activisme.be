<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Tag;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;

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
    public function model(): string
    {
        return Tag::class;
    }

    /**
     * Haal alle catego)rieen op in de databank. 
     * 
     * @param  int $perPage Het aantal categorieen dat je wilt weergeven per pagina. 
     * @return \Illuminate\Pagination\Paginator
     */
    public function getTags(int $perPage): Paginator
    {
        return $this->entity()->simplePaginate($perPage);
    }
}