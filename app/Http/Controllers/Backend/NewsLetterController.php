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
        //
    }

    public function destroy(string $slug): RedirectResponse
    {
        //
    }
}
