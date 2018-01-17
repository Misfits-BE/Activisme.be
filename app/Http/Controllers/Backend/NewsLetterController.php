<?php

namespace ActivismeBe\Http\Controllers\Backend;

use ActivismeBe\Http\Requests\Frontend\NewsLetterValidator;
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
     * @todo Registratie routering 
     * @todo Registratie en opbouwen view 
     * 
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View 
    {
        $letter = $this->newsMailingRepository->findLetter($slug);
        return view('mail.newsletter.email', compact('letter'));
    }

    /**
     * Slaag een nieuwsbrief op in het systeem. 
     * ---
     * Na de opslag word ook de nieuwsbrief verzonden naar de gebruikers.
     * 
     * @todo Registratie routering
     * @todo Implementatie van een breadcrumb in de view. 
     * @todo implementatie validator 
     * @todo implementatie activiteiten logger. 
     *
     * @param  NewsLetterValidator $input   De gegeven gebruikers invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsLetterValidator $input): RedirectResponse
    {
        //
    }

    /**
     * De formulier weergave om een nieuwsbràief te wijzigen. 
     * ----
     * INFO: De nieuwsbrief kan alleen gewijzigd worden wanneer hij een kladstatus heeft
     *       en nog niet gepubliceerd is.  
     * 
     * @todo Registratie routering
     * @todo Registratie van een breadcrumb in de view. 
     * @todo Implementatie validator.
     * 
     * @param  string $slug De unieke identificatie van de nieuwsbrief in het systeem. 
     * @return \Illuminate\View\View
     */
    public function edit(string $slug): View 
    {
        //
    } 

    /**
     * Opslag method voor de wijzigingen aan een nieuwsbrief
     * ---- 
     * INFO: De wijzigingen aan een nieuwsbrief kunnen alleen opgeslagen worden als 
     *       de nieuwsbrief een klad status heeft en nog niet gepubliceerd en verzonden is. 
     * 
     * @todo Registratie routering 
     * @todo Implementatie validator
     * @todo Implementatie activiteiten logger.
     * @todo Implementatie queue worker die de mail zend naar de subscribers.
     *
     * @param  NewsLetterValidator $input   De gegeven gebruikers invoer. (gevalideerd)
     * @param  string              $slug    De unieke identificatie van de nieuwsbrief in het systeem.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsLetterValidator $input, string $slug): RedirectResponse
    {
        $repository = $this->newsMailingRepository; 
        $letter     = $repository->findLetter($slug);

        if ($repository->isNotPublished($letter) && $repository->isDraftVersion($letter) && $repository->isNotSend($letter)) { // @see docblock 'INFO' section
            if ($input->send) { // De nieuwsbrief heeft in de wijzigingen een 'verzenden status gekreken'. 
                $input->merge(['is_send' => 1]); // Indicatie 1 = true | Nieuwsbrief moet verzonden verzonden worden.
                // TODO: Aparte log message nodig voor de verzending. 
                // TODO: queue worker voor de verzending
            }

            if ($repository->updateNewsLetter($letter->id, $input->except('_token'))) { // De nieuwsbrief is aangepast in het systeem.

                flash('De nieuwsbrief is aangepast. En mogelijks ook verzonden.')->success()->important();
            }
        }

        return redirect()->route('admin.nieuwsbrief.index');
    }

    /**
     * Verwijder een nieuwsbvrief in het systeem. 
     * 
     * @todo Registratie routering 
     * @todo Activiteiten logger.
     * 
     * @param  string $slug De unieke indentificatie van de nieuwsbrief in het systeem. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function destroy(string $slug): RedirectResponse
    {
        if ($this->newsMailingRepository->deleteLetter($slug)) {
            flash('De nieuwsbrief is verwijderd uit het systeem.')->success();
        }

        return redirect()->route('admin.nieuwsbrief.index');
    }
}
