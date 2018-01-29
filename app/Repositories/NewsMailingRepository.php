<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\NewsMailing;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;

/**
 * Class NewsMailingRepository
 *
 * @package ActivismeBe\Repositories
 */
class NewsMailingRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return NewsMailing::class;
    }

    /**
     * Haal alle nieuwsberichten op voor de beheers console. 
     * 
     * @param  string|null  $type     Het type van de paginator view instantie
     * @param  int          $perPage  Het aantal nioeuwsbrieven dat je wilt weergeven per pagina
     * @return \Illuminate\Pagination\Paginator
     */
    public function getAllPaginate(string $type = null, int $perPage): Paginator 
    {
        switch ($type) {
            case 'simple':  return $this->entity()->simplePaginate($perPage); 
            case 'default': return $this->entity()->paginate($perPage); 
            default: return $this->paginate($perPage);
        }
    }

    /** 
     * Find een nieuwsbrief op basis van zijn unieke identificatie slug. 
     * 
     * @param  string $slug  De unieke identificatie string in de databank.
     * @return \ActivismeBe\NewsMailing
     */
    public function findLetter(string $slug): NewsMailing
    {
        return $this->entity()->whereSlug($slug)->firstOrFail();
    }
}