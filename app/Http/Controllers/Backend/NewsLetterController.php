<?php

namespace ActivismeBe\Http\Controllers\Backend;

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
    /**
     * @var NewsMailingRepository $newsletterRepository
     */
    private $newsMailingRepository; 

    /**
     * NewsLetterController constructor 
     * 
     * @param  NewsMailingRepository $newsletterRepository Abstractie laag tussen logica, controller, databank.
     * @return void
     */
    public function __construct(NewsMailingRepository $newsMailingRepository) 
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
        $this->newsMailingRepository = $newsMailingRepository;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): RedirectResponse 
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
     *       de nieuwsbrief een klad status heeft en nog niet gepubliceerd is. 
     * 
     * @todo Registratie routering 
     * @todo Implementatie validator
     * 
     * @param  string $slug De unieke identificatie van de nieuwsbrief in het systeem. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $slug): RedirectResponse 
    {
        $repository = $this->newsMailingRepository; 
        $letter     = $repository->findLetter($slug);

        if ($repository->isNotPublished($letter) && $repository->isDraftVersion($letter)) {
            if ($repository->updateNewsLetter($letter->id, $input->except('_token'))) { // De nieuwsbrief is aangepast in het systeem.
                if ($input->status == 'send') {                                         // De nieuwsbrief heeft in de wijzigingen een 'verzenden status gekreken'. 
                    // TODO: implementatie queue worker die de mail zend naar de subscribers.
                }

                flash('De nieuwsbrief is aangepast. En mogelijks ook verzonden.')->success()->important();
            }
        } 
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
