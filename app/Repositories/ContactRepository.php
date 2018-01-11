<?php 

namespace ActivismeBe\Repositories;

use ActivismeBe\Contact;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;

/**
 * Class ContactRepository
 *
 * @package ActivismeBe\Repositories
 */
class ContactRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }

    /**
     * Haal de contacten op in de databank.
     *
     * @param  string $type    De type v/d paginatie view instantie
     * @param  int    $perPage De aantal resultaten per pagina
     * @return \Illuminate\Pagination\Paginator
     */
    public function listContacts($type = 'default', $perPage): Paginator
    {
        switch ($type) {
            case 'default': return $this->entity()->paginate($perPage);
            case 'simple':  return $this->entity()->simplePaginate($perPage);
            default:        return $this->entity()->paginate($perPage);
        }
    }
}