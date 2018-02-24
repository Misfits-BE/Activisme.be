<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DisclaimerControllerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class DisclaimerControllerTest extends TestCase
{
    /**
     * @test
     * @testdox Test of een gast successvol de disclaimer pagina kan zien
     */
    public function disclaimerTest(): void
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
