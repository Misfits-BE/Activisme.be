<?php 

namespace ActivismeBe\Repositories;

use Carbon\Carbon;
use ActivismeBe\NewsMailing;
use ActivismeBe\Newsletter;
use ActivismeBe\Notifications\SendNewsletter;
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
     * @param  string $uuid unieke identificatie van het email adres.
     * @return \ActivismeBe\NewsLetter
     */
    public function findEmail(string $uuid): NewsLetter 
    {
        return $this->entity()->where('unsubscribe_token', $uuid)->firstOrFail();
    }

    /**
     * Registreer de nieuwsbrieven in de queue waar vervolgens de worker ze kan versturen 
     * 
     * @return void
     */
    public function send(NewsMailing $message): void
    {
        foreach($this->all() as $person) {
            $person->notify((new SendNewsletter($message))->delay(Carbon::now()->addMinute(1)));
        }
    }
}