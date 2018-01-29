<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Github\Client;
use ActivismeBe\Http\Requests\Backend\BugValidator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;
use ActivismeBe\Http\Controllers\Controller;

/**
 * [Backend]: Bug controller 
 * 
 * Deze controller is toegewijd als brug tussen de issue tracker op github. 
 * Zodat een gebruiker een fout tegenkomt deze automatisch in de bug tracker van gehub word geplaatst.
 *  
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class BugController extends Controller
{
    /**
     * BugController constructor 
     * 
     * @param  Client $github De GitHub api client wrapper. 
     * @return void
     */
    public function __construct(Client $github) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $github->authenticate(config('github.user.name'), config('github.user.pass'), $github::AUTH_HTTP_PASSWORD); 
        $this->github = $github;
    }

    /**
     * De creatie pagina voor een fout melding. 
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        return view('backend.bugs.report', [
            'labels' => $this->github->api('issue')->labels()->all(
                config('github.repo.organization'), config('github.repo.name')
            )
        ]);
    }

    /**
     * Opslag van het formulier in de GitHub Issue tracker. 
     * 
     * @param  BugValidator $input De gegeven gebruikers invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BugValidator $input): RedirectResponse
    {
        $apiBase = $this->github->api('issue'); // The base builder for the api. 

        // Slaag de foutmelding op. (GitHub)
        $create = $apiBase->create(
            config('github.repo.organization'), config('github.repo.name'), [
                'title' => $input->titel, 'body' => $input->beschrijving
            ]
        );

        // Attacheer een label aan het vooraf aangemaakte ticket. 
        $attach = $apiBase->labels()->add(
            config('github.repo.organization'), config('github.repo.name'), $create['number'], $input->label
        );

        if ($create && $attach) {
            flash('Jouw rapportering is opgeslagen. Wij kijen er snel naar. Bedankt voor de melding')
                ->success();
        }

        return redirect()->route('bug.index');
    }
}
