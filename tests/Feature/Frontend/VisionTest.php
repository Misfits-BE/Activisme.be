<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class VisionTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class VisionTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the quest can view the vision page without errors
     */
    public function visionIndex()
    {
        $this->get(route('visie.index'))->assertStatus(200);
    }
}
