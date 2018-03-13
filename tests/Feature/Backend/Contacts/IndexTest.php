<?php

namespace Tests\Feature\Backend\Contacts;

use Tests\CreatesUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class IndexTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Backend\Contacts
 */
class IndexTest extends TestCase
{
    use RefreshDatabase, CreatesUser;

    /**
     * @test
     * @testdox test Of een niet aangemelde gebruiker de pagina niet kan bereiken.
     */
    public function nietAangemeld(): void
    {
        $this->get(route('admin.contacts.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @test test Of een gebruiker met de verkeerde permissies de pagina niet kan weergeven
     */
    public function verkeerdePermissie(): void
    {
        $user = $this->createNormalUser();

        $this->actingAs($user)
            ->get(route('admin.contacts.index'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * @test
     * @testdox Test of een gebruiker met de juiste permissies de pagina kan bekijken zonder errors
     */
    public function juistePermissie(): void
    {
        $user = $this->createAdminUser();

        $this->actingAs($user)
            ->get(route('admin.contacts.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een geblokkeerde gebruiker de contact index pagina niet kan bekijken
     */
    public function geblokkeerdeGebruiker(): void
    {
        $user = $this->createBlockedUser();

        $this->actingAs($user)
            ->get(route('admin.contacts.index'))
            ->assertStatus(403);
    }
}
