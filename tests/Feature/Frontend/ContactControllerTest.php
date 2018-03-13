<?php

namespace Tests\Feature\Frontend;

use ActivismeBe\Mail\sendContactForm;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ContactControllerTest
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Frontend
 */
class ContactControllerTest extends TestCase
{
    /**
     * @test
     * @testdox Test of een gebruiker effectief het contact formulier kan verzenden.
     */
    public function zendZonderFouten(): void
    {
        Mail::fake();

        $input = ['email' => 'example@domain.tld', 'bericht' => 'Test message'];

        $this->post(route('contact.send'), $input)
            ->assertStatus(302);

        // Test if the mailable is sent.
        Mail::assertSent(sendContactForm::class, function ($mail) use ($input) {
            return $mail->hasTo(config('platform.contact.email'));
        });
    }

    /**
     * @test
     * @testdox Test de validatie fouten bij het foutief invullen van het contact formulier
     */
    public function zendMetFoutenRequired(): void
    {
        Mail::fake();

        $this->post(route('contact.send'), [])
            ->assertSessionHasErrors([
                'email' => 'e-mailadres is verplicht.',
                'bericht' => 'bericht is verplicht.'
            ])
            ->assertStatus(302);

        Mail::assertNotSent(sendContactForm::class);
    }

    /**
     * @test
     * @testdox Test de validatie fout bij het invullen van een foutief email adres
     */
    public function zendMetFoutiefEmailAdres(): void
    {
        Mail::fake();

        $this->post(route('contact.send'), ['email' => 'wrong email', 'bericht' => 'test message'])
            ->assertSessionHasErrors(['email' => 'e-mailadres is geen geldig e-mailadres.'])
            ->assertStatus(302);

        Mail::assertNotSent(sendContactForm::class);
    }
}
