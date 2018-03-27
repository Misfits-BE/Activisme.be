<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DisclaimerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Test is a quest can view the disclaimer page without errors
     */
    public function indexTest(): void
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
