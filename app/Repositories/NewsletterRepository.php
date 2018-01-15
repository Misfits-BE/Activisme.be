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

    /**
     * Vind een specifiek email adres in de databank en haal deze op. 
     * ---
     * Deze functie geeft ook een HTTP/1 404 - Not Found terug. 
     * Als er geen email adres onder de uuid word gevonden. 
     * 
     * @param  string $uuidde unieke identificatie van het email adres.
     * @return \ActivismeBe\NewsLetter
     */
    public function findEmail(string $uuid): NewsLetter 
    {
        return $this->entity()->where('unsubscribe_token', $uuid)->firstOrFail();
    }
}