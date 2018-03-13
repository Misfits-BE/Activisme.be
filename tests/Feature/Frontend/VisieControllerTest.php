<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class VisieControllerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class VisieControllerTest extends TestCase
{
    /**
     * @test
     * @testdox Test of de visie pagina bereikbaar is zonder problemen.
     */
    public function visiePagina(): void
    {
        $this->get(route('visie.index'))->assertStatus(200);
    }
}
