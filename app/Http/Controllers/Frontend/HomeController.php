<?php

namespace ActivismeBe\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ActivismeBe\Repositories\TagRepository;
use ActivismeBe\Repositories\ArticleRepository;
use ActivismeBe\Http\Controllers\Controller;

/**
 * [Frontend]: Home controller 
 * 
 * De controller voor de voorpagina van de applicatie. 
 * 
 * @author      Tim Joosten <Topairy@gmail.com>
 * @copyright   2017 Tim Joosten
 */
class HomeController extends Controller
{
    private $tagRepository;     /** @var TagRepository     $tagRepository     */
    private $articlerepository; /** @var ArticleRepository $articleRepository */

    /**
     * HomeController Constructor
     * 
     * @param  TagRepository        $tagRepository      De abstractie laag tussen controller, logica en database
     * @param  ArticleRepository    $articleRepository  De abstractie laag tussen controller, logica en database
     * @return void
     */
    public function __construct(TagRepository $tagRepository, ArticleRepository $articleRepository) 
    {
        $this->tagRepository     = $tagRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * De frontend controller voor de begin pagina van de applicatie.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        $articles = $this->articleRepository->entity()
            // ->whereDate('publish_date', '>=', Carbon::today()->toDateString())
            ->where('is_published', 'Y')
            ->orderBy('created_at', 'desc');
            
        return view('frontend.welcome', [
            'tags'     => $this->tagRepository->entity()->inRandomOrder()->take(20)->get(), 
            'article'  => $articles->first(),
            'articles' => $articles->skip(1)->take(4)->get()
        ]);
    }
}
