<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use ActivismeBe\Repositories\ArticleRepository;
use ActivismeBe\Repositories\TagRepository;
use Illuminate\View\View;
use ActivismeBe\Http\Controllers\Controller;

/**
 * Class CategoryController
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     ActivismeBe\Http\Controllers\Frontend
 */
class CategoryController extends Controller
{
    private $articles; /** @var \ActivismeBe\Repositories\ArticleRepository $articles */
    private $tags;     /** @var \ActivismeBe\Repositories\TagRepository     $tags     */

    /**
     * CategoryController constructor.
     *
     * @param  TagRepository      $tags      The abstraction layer between controller and database.
     * @param  ArticleRepository  $articles  The abstraction layer between controller and database.
     * @return void
     */
    public function __construct(ArticleRepository $articles, TagRepository $tags)
    {
        $this->articles = $articles;
        $this->tags     = $tags;
    }

    /**
     * Get the page for nieuws messages on one category.
     *
     * @param  string  $slug  The unique identifier from the category in the database.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $slug)
    {
        $articles = $this->articles->entity()->whereHas('tags', $filter = function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->where('is_published', 'Y')->orderBy('created_at', 'desc');

        if ($articles->count() === 0) {
            return redirect('/nieuws');
        }

        return view('frontend.articles.index', [
            'articles' => $articles->simplePaginate(6),
            'tags'     => $this->tags->all()
        ]);
    }
}
