<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;
use ActivismeBe\Repositories\NewsletterRepository;
use ActivismeBe\Http\Requests\Frontend\NewsLetterValidator;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use ActivismeBe\Notifications\RegisterNewsLetter;

/**
 * NewsLetterController 
 * 
 * De controller voor het nieuws berichten systeem. Deze staat bij in de backend 
 * omdat het aanmaken voor 1 functie een frontend controller te zot is. 
 * 
 * @todo registratie flash session in de nieuws en frontend welcome view.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class NewsLetterController extends Controller
{
    /**
     * @var NewsLetterRepository $newsletterRepository
     */
    private $newsletterRepository; 

    /** 
     * NewsLetterController constructor 
     * 
     * @param  NewsLetterRepository $newsletterRepository Abstractie laag tussen logica, controller en database model.
     * @return void
     */
    public function __construct(NewsletterRepository $newsletterRepository) 
    {
        $this->middleware(['auth', 'forbid-banned-user', 'role:admin'])->except(['store', 'unsubscribe']);
        $this->newsletterRepository = $newsletterRepository;
    }

    /**
     * Slaag de gegevens van de gast gebruiker op in de databank. 
     * 
     * @param  NewsLetterValidator $input De gegevens gebruikers invoer (gevalideerd)  
     * @return \Illuminate\View\View
     */
    public function store(NewsLetterValidator $input): RedirectResponse  
    {
        $input->merge(['unsubscribe_token' => Uuid::uuid4()]); 

        if ($user = $this->newsletterRepository->create($input->except('_token'))) {
            $user->notify((new RegisterNewsLetter($user))->delay(Carbon::now()->addMinute(1)));
            flash("We hebben jouw ingeschreven op de nieuwsbrief.")->success(); 
        }

        return back(302); // Stuur de gast gebruiker terug naar de vorige pagina. 
    }

    /**
     * Verwijder een persoon uit de ontvangers voor de nieuwsbrief. 
     * 
     * @todo registratie mail notificatie dat de gebruiker is uitgeschreven.
     * 
     * @param  string $uuid The unieke identificatie van de gebruiker.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(string $uuid): RedirectResponse 
    {
        $person = $this->newsletterRepository->findEmail($uuid);

        if ($person->delete()) {
            flash('We hebben je verwijderd uit de mailinglijst voor onze nieuwsbrief.')->success();
        }

        return redirect()->route('home.front');
    }
}
