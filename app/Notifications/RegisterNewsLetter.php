<?php

namespace ActivismeBe\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterNewsLetter extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var $input
     */

    /**
     * Create a new notification instance.
     *
     * @param  array $input De gegeven gebruiker invoer vanuit de input. 
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bedankt om je te registreren op onze nieuwsbrief.')
            ->markdown('mail.newsletter.register');
    }
}
