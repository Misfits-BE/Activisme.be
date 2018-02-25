<?php

namespace ActivismeBe\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserBlocked extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var $dbUser The blocked user entity */
    public $dbUser; 

    /** @var $authUser The currently authenticated user. */
    public $authUser;

    /**
     * Create a new notification instance.
     *
     * @param  mixed $dbUser    The blocked user entity
     * @param  mixed $authUser  The currently authenticated user
     * @return void
     */
    public function __construct($dbUser, $authUser)
    {
        $this->dbUser   = $dbUser; 
        $this->authUser = $authUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Uw account is tijdelijk geblokkeerd.')
            ->markdown('mail.users.blocked', ['user' => $this->dbUser]);
    }
}
