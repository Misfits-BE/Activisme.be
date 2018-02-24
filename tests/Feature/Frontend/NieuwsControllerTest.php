<?php

namespace Tests\Feature\Frontend;

use ActivismeBe\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class NieuwsControllerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package Tests\Feature\Frontend
 */
class NieuwsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test de nieuws index wanneer er berichten zijn in het bericht.
     */
    public function indexMetBerichten(): void
    {
        factory(Article::class, 30)->create(['is_published' => 1]);

        $this->get(route('news.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat de gast word omgeleid wanneer er geen berichten zijn.
     */
    public function indexZonderBerichten(): void
    {
        $this->get(route('news.index'))
            ->assertStatus(302)
            ->assertRedirect(route('home.front'));
    }

    /**
     * @test
     * @testdox Test of een gast een artikel kan zien zonder problemen.
     */
    public function weergaveGeldigeSlug(): void
    {
        $article = factory(Article::class)->create();

        $this->get(route('news.show', ['slug' => $article->slug]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test de error response wanneer de gast een artikel wilt zien met ongeldige slug
     */
    public function weergaveOngeldigeSlug(): void
    {
        $this->get(route('news.show', ['slug' => 'article-slug']))
            ->assertStatus(404);
    }
}
