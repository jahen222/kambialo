<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class MatchConfirm extends Notification
{
    use Queueable;

    private $userMatch;
    private $match;
    private $message;
    private $subject;
    private $via;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userMatch, $match, $message, $subject = 'Kambialo - Han confimado el Match', array $via = ['broadcast', 'database', 'mail'])
    {
        $this->userMatch = $userMatch;
        $this->match = $match;
        $this->message = $message;
        $this->subject = $subject;
        $this->via = $via;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject($this->subject)->view(
            'emails.match',
            ['user' => $notifiable, 'userMatch' => $this->userMatch, 'match' => $this->match]
        );
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return (new BroadcastMessage($this->toArray($notifiable)));
    }    

    /**
     * Get the type of the notification being broadcast.
     *
     * @return string
     */
    public function broadcastType()
    {
        return 'broadcast.message';
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => route('match.show', $this->match->id)
        ];
    }
}
