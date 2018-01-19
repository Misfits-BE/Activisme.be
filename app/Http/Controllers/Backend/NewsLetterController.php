<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Carbon\Carbon;
use ActivismeBe\Http\Requests\NewsMailValidator;
use ActivismeBe\Repositories\NewsletterRepository;
use ActivismeBe\Repositories\NewsMailingRepository;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * NewsLetter Controller 
 * ----
 * Backend controller voor het beheer van de nieuwsbrieven. 
 * 
 * @todo Implementatie PHPUnit tests.
 * @todo Implementatie functie repository ->deleteLetter($slug); | HTTP/1 404 - Not Found respons wanneer niet gevonden
 * @todo Implementatie functie repository ->findLetter($slug);   | HTTP/1 404 - Not Found respons wanneer niet gevonden. 
 * @todo Implementatie functie repository ->updateNewsLetter((int) $nieuwsbriefId, (array) $input)
 * @todo Implementatie functie repository ->isNotPublished($letter)
 * @todo Implementatie functie repository ->isDraftVersion($letter)
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class NewsLetterController extends Controller
{
    /* @var \ActivismeBe\Repositories\NewsMailingRepository */
    private $newsMailingRepository;

    /** @var \ActivismeBe\Repositories\NewsletterRepository */
    private $subscribers;

    /**
     * NewsLetterController constructor
     *
     * @param  NewsMailingRepository $newsMailingRepository Abstractie laag tussen controller, logica, database
     * @param  NewsletterRepository  $subscribers           Abstractie laag tussen controller, logica, database
     * @return void
     */
    public function __construct(NewsMailingRepository $newsMailingRepository, NewsletterRepository $subscribers)
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);

        $this->newsMailingRepository = $newsMailingRepository;
        $this->subscribers           = $subscribers;
    }

    /**
     * De beheers console foor de nieuwsbrieven.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('backend.newsletter.index', [
            'letters' => $this->newsMailingRepository->getAllpaginate('simple', 15)
        ]);
    }

    /**
     * Geef een voorbeeld weergave weer van de nieuwsbrief. 
     *
     * @todo Registratie en opbouwen view 
     *
     * @param  string $slug De unieke identificatie waarde van het nieuwsbericht.
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View 
    {
        return view('mail.newsletter.email', [
            'letter' => $this->newsMailingRepository->findLetter($slug)
        ]);
    }

    /**
     * Creatie weergave voor een nieuwe nieuwsbericht.
     *
     * @todo opbouwen view.
     *
     * @return\Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.newsletter.create');
    }

    /**
     * Slaag een nieuwsbrief op in het systeem. 
     * ---
     * Na de opslag word ook de nieuwsbrief verzonden naar de gebruikers
     * als dat is aangegeven.
     *
     * @param  NewsMailValidator $input   De gegeven gebruikers invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsMailValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]);

        if ($newsletter = $this->newsMailingRepository->create($input->except('_token'))) {
            if ((bool) $input->is_send) {   // Men wilt de nieuwsbrief verzenden.
                $this->newsMailingRepository->findLetter($newsletter->slug)->update([
                    'status' => 'publicatie', 'send_at' => Carbon::now()
                ]);
                
                $this->subscribers->send($newsletter); // Zend de nieuwsbrief naar de ingeschreven leden.
                $this->writeActivity('nieuwsbrief', $newsletter, 'Heeft een nieuwsbrief verzonden naar de leden.');
            }

            flash('Heeft een nieuwsbrief aangemaakt')->success();
        }

        return redirect()->route('admin.nieuwsbrief.index');
    }

    /**
     * Verwijder een nieuwsbvrief in het systeem. 
     * 
     * @todo Registratie routering 
     * 
     * @param  string $slug De unieke indentificatie van de nieuwsbrief in het systeem. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function destroy(string $slug): RedirectResponse
    {
        $letter = $this->newsMailingRepository->findLetter($slug); 

        if ($letter->delete()) {
            $this->writeActivity('nieuwsbrief', $letter, 'Heeft een nieuwsbrief verwijderd.');

            flash('De nieuwsbrief is verwijderd uit het systeem.')->success();
        }

        return redirect()->route('admin.nieuwsbrief.index');
    }
}
