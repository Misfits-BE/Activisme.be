<?php

namespace ActivismeBe\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use ActivismeBe\Http\Controllers\Controller;
use ActivismeBe\Repositories\TagRepository;
use ActivismeBe\Http\Requests\Backend\TagValidator;

/**
 * Categorieeen controller waar alle categorieen van nieuwsberichten kunnen beheerd worden. 
 *  
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 * @package     \ActivismeBe\Http\Controllers\Backend
 */
class TagsController extends Controller
{
    /** @var \ActivismeBe\Repositories\TagRepository $tagRepository */
    private $tagRepository; 

    /**
     * TagsController Constructor 
     * 
     * @param  TagRepository $tagRepository     Abstractie laag tussen logica, controller en database. 
     * @return void 
     */
    public function __construct(TagRepository $tagRepository) 
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
        $this->tagRepository = $tagRepository;
    }

    /** 
     * De index weergave voor het beheers overzicht van de nieuws categorieen. 
     * 
     * @todo Plaatsen van pagination view instantie (index view)
     * @todo Implementatie tooltips voor de opties
     * @todo Implementatie phpunit test (no auth, wrong permissions, correct permission, banned user)
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View  
    {
        return view('backend.categories.index', [
            'categories' => $this->tagRepository->getTags(15)
        ]);
    }

    /**
     * De creatie pagina voor een nieuwe categorie. 
     *
     * @todo Implementatie phpunit test (no auth, wrong permissions, correct permissions, banned user)
     *
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view('backend.categories.create');
    }

    /** 
     * Opslag methode voor een nieuwe categorie in het systeem. 
     * 
     * @todo Implementatie phpunit test (no auth, wrong permissions, correct permissions, banned user, request OK, request validation errors)
     * 
     * @param  TagValidator $input  De invoer van de gebruiker (gevalideerd).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagValidator $input): RedirectResponse 
    {
        $input->merge(['author_id' => $input->user()->id]);

        if ($tag = $this->tagRepository->create($input->except('_token'))) {
            flash("Je hebt de categorie {$tag->name} opgeslagen in het systeem.")->success();
            $this->writeActivity('categories', $tag, 'Heeft een categorie voor de nieuwsberichten toegevoegd.');
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * De weergave voor het wijzigen van een categorie in het systeem.
     * 
     * @todo Opbouwen van de view
     * @todo Implementatie phpunit test (no auth, wrong permissions, correct permissions, banned user, ID = OK, ID = NOK)
     * 
     * @param  int $tag     De unieke identificatie van de categorie in de databank. 
     * @return \Illuminate\View\View
     */
    public function edit(int $tag): View 
    {
        return view('backend.categories.edit', [
            'category' => $this->tagRepository->findOrFail($tag),
        ]); 
    }

    /**
     * Methode voor het aanpassen van een categorie in het systeem. 
     * 
     * @todo Implementatie routering (web.php)
     * @todo implementatie routering (edit weergave)
     * @todo Opbouwen controller logic (activiteiten logger niet vergeten)
     * @todo implementatie phpunit test (no auth, permission = OK, permission = NOK, banned user, Request OK, Request Validation error)
     * 
     * @param  TagValidator $input      De gegeven gebruikers invoer (gevalideerd)
     * @param  int          $tag        De unieke identificatie van de categorie in de databank. 
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(TagValidator $input, int $tag): RedirectResponse 
    {
        //
    }


    /**
     * Verwijder een categorie uit het databank systeem. 
     * 
     * @todo Implementatie phpunit test (no auth, permission = OK, permission = NOK, banned useer, ID = OK, ID = NOK)
     * 
     * @param  int $tag     De unieke identicatie van de categorie in de databank. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $tag): RedirectResponse
    {
        $tag = $this->tagRepository->findOrFail($tag);

        if ($tag->delete()) {
            $tag->articles()->sync([]);

            $this->writeActivity('categories', $tag, 'heeft een nieuws categorie verwijderd uit het systeem');
            flash("Je hebt de categorie {$tag->name} verwijderd uit het systeem.")->success()->success();
        } 

        return redirect()->route('admin.categories.index');
    }
}
