<?php

namespace Tests\Feature\Frontend;

use ActivismeBe\Calendar;
use ActivismeBe\Events;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class KalenderControllerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class KalenderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een gast de kalender kan zien zonder data
     */
    public function testIndexZonderData(): void
    {
        $this->get(route('calendar.index'))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een gast de kalender kan zien met data
     */
    public function testIndexMetData(): void
    {
        factory(Events::class, 20)->create()
            ->each(function($entity) {
                $entity->dates()->save(factory(Calendar::class)->create());
            });

        $this->get(route('calendar.index'))->assertStatus(200);
    }
}
