<?php

namespace ActivismeBe\Http\Controllers\Backend;

use ActivismeBe\Repositories\ArticleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use ActivismeBe\Http\Controllers\Controller;

/**
 * [Backend]: ArticleStatusController 
 * 
 * De ze controller heeft alleen maar een ->update() methode. Omdat het het alleen 
 * over de status van het artikel gaat. Zie de backend ArticleController voor alle andere
 * beheer functies omtrent artikelen.
 * 
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright 2017 Tim Joosten
 */
class ArticleStatusController extends Controller
{
    private $articleRepository; /** @var ArticleRepository $articleRepository */

    /**
     * ArticleStatusController constructor
     *
     * @param  ArticleRepository $articleRepository Abstractie laag tussen controller en database.
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware(['role:admin', 'forbid-banned-user']);
        $this->articleRepository = $articleRepository;
    }

    /**
     * Update de status van een artikel in de databank.
     * 
     * @param  int    $article De unieke identificatie van het artikel in de db.
     * @param  string $status  De status indicatie van het artikel. (Y = publicatie, N = Klad versie)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($article, $status): RedirectResponse
    {
        $article = $this->articleRepository->findOrFail($article);

        if ($article->update(['is_published' => $status])) {
            switch ($status) {
                case 'N': $flashMessage = "De status van {$article->title} is gewijzigd naar 'klad versie'"; break;
                case 'Y': $flashMessage = "De status van {$article->title} is gewijzigd naar 'publicatie'";  break;
            }

            activity('articles-log')->performedOn($article)->causedBy(auth()->user())
                ->log("Heeft de status van het article '{$article->title}' gewijzigd.");

            flash($flashMessage)->success();
        }

        return redirect()->route('admin.articles.index');
    }
}
