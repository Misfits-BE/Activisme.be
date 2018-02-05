<?php

namespace ActivismeBe\Http\Controllers\Backend;

use ActivismeBe\Http\Requests\Backend\NewsUpdateValidator;
use ActivismeBe\Http\Requests\Backend\NewsValidator;
use ActivismeBe\Repositories\ArticleRepository;
use ActivismeBe\Repositories\TagRepository;
use Illuminate\Http\RedirectResponse;
use ActivismeBe\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * [Backend]: ArticleController
 * 
 * De controller die gebruikt word voor het management van artikelen. Indien 
 * u zoekt naar de controller voor de artikel status. Dan vind u deze in de ArticleStatusController 
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class ArticleController extends Controller
{
    private $articleRepository; /** @var Articlerepository  $articleRepository */
    private $tagRepository;     /** @var TagRepository      $tagRepository     */

    /**
     * ArticleController constructor.
     *
     * @param  ArticleRepository $articleRepository  Abstractie laag tussen controller en artikel logica, database.
     * @param  TagRepository     $tagRepository      Abstractie laag tussen controller en tag logica, database. 
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->middleware(['role:admin', 'forbid-banned-user']);

        $this->articleRepository = $articleRepository;
        $this->tagRepository     = $tagRepository;
    }

    /**
     * Methode voor het overzicht van nieuws artikelen.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.articles.index', [
            'articles' => $this->articleRepository->entity()->simplePaginate(15)
        ]);
    }

    /**
     * Formulier voor het creeren van een nieuw artikel. 
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('backend.articles.create', ['categories' => $this->tagRepository->all(['id', 'name'])]);
    }

    /**
     * Methode voor de opslag van een artikel in de databank. 
     *
     * @param  NewsValidator $input De gegeven gebruikers data. (gevalideerd).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]);

        if ($article = $this->articleRepository->create($input->all())) {
            $article->tags()->attach($input->categories); 
            $article->addMedia($input->file('image'))->toMediaCollection('images');

            activity('articles-log')->performedOn($article)->causedBy($input->user())
                ->log("Heeft '{$article->title}' toegevoegd als nieuws artikel.");

            flash("Het nieuws artikel is opgeslagen in het systeem.")->success();
        }

        return redirect()->route('admin.articles.index');
    }

    /**
     * Formulier voor het wijzigen van een artikel. 
     * 
     * @param  int $article De unieke waarde voor de data in de databank. (PK) 
     * @return \Illuminate\View\View
     */
    public function edit($article): View
    {
        $article = $this->articleRepository->findOrFail($article);
        return view('backend.articles.edit', compact('article', 'categories'));
    }

    /**
     * Methode om de wijzigen van een bestaan artikel op te slaan.
     * 
     * @todo De controller moet nog verder worden uitgewerkt. 
     *
     * @param  NewsUpdateValidator  $input   Het object voor de opgegeven gebruikers data. (gevalideerd)
     * @param  int                  $article De unieke waarde voor de data in de databank. (PK)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsUpdateValidator $input, $article): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]);
        return redirect()->route('admin.articles.index');
    }

    /** 
     * Verwijder een artikel uit de databank.
     * 
     * @param  int $article De unieke waarde van het artikel in de database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($article): RedirectResponse
    {
        $article = $this->articleRepository->findOrFail($article);

        if ($article->delete()) {
            $article->tags()->sync([]); // Detachering van alle categorieen v/h artikel. 

            activity('articles-log')->performedOn($article)->causedBy(auth()->user())
                ->log("Heeft het artikel '{$article->title}' verwijderd");

            flash("Het artikel {$article->title} is verwijderd uit het platform")->success();
        }

        return redirect()->route('admin.articles.index');
    }
}
