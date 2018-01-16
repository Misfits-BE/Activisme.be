<?php

namespace ActivismeBe\Http\Controllers\Backend;

use ActivismeBe\Repositories\NewsMailingRepository;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * NewsLetter Controller 
 * 
 * Backend controller voor het beheer van de nieuwsbrieven. 
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): RedirectResponse 
    {
        //
    }
}
