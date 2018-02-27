<?php

namespace ActivismeBe\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * De notificatie om de nieuwsbrief bij de ingeschreven leden te krijgen. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \ActivismeBe\Notifications
 */ 
class SendNewsletter extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * De nieuwsbrief meta. 
     *
     * @return NewsMailing $message
     */
    public $message;

    /**
     * Create a new notification instance.
     *
     * @param  $message   De nieuwsbrief data vanuit de databank.
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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
            ->subject($this->message->titel)
            ->view('mail.newsletter.email', [
                'title'   => $this->message->titel,
                'content' => $this->message->content
            ]);
    }
}
