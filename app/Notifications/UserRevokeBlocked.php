<?php

namespace ActivismeBe\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRevokeBlocked extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var \ActivismeBE\User $user */
    public $user; 

    /**
     * Create a new notification instance.
     *
     * @param  \ActivismeBe\User  $user  
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
            ->subject('Uw account is terug geactiveerd op ' . config('app.name') .  '.')
            ->markdown('mail.users.revoke-blocked', ['user' => $this->user]);
    }
}
