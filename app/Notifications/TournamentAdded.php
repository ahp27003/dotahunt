<?php

namespace App\Notifications;

use App\Tournament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class TournamentAdded extends Notification
{
    use Queueable;

    protected $tournament;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['database', 'broadcast'];
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            $this->tournament
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->tournament->name
        ];
    }

    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     $this->tournament
        // ]);

        return (new BroadcastMessage([$this->tournament]))->onConnection('sync');
    }
}
