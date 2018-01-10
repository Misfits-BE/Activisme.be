<?php

namespace Tests\Feature;

use ActivismeBe\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of men de nieuws pagina kan bekijken zonder problemen.
     */
    public function index(): void
    {
        factory(Article::class)->create();

        $this->get(route('news.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat men de gebruiker doorstuurd naar de index wegens geen nieuws.
     */
    public function indexNoNews(): void
    {
        $this->get(route('news.index'))
            ->assertStatus(302)
            ->assertRedirect(route('home.front'));
    }

    /**
     * @test
     * @testdox Test of een gebruiker successvol een specifiek nieuws bericht kan zien.
     */
    public function articleShowSuccess(): void
    {
        $article = factory(Article::class)->create();

        $this->get(route('news.show', ['slug' => $article->slug]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test de error response wanneer een nieuws artikel niet bestaat.
     */
    public function articleShowInvalid(): void
    {
        $this->get(route('news.show', ['slug' => 'article-slug']))
            ->assertStatus(404);
    }
}
