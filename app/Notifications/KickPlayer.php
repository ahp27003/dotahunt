<?php

namespace App\Notifications;

use App\Team;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class KickPlayer extends Notification
{
    use Queueable;

    protected $team;
    public function __construct(Team $team)
    {
        $this->team = $team;
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
            ->line('Team' . $this->team->name . ' has kick you out from the team')
            ->action('View', url('/notifications'))
            ->line('Dont give up!');
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
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     $this->tournament
        // ]);

        return (new BroadcastMessage([
            'team_id' => $this->team->id,
            'team_name' => $this->team->name,
        ]))->onConnection('sync');
    }
}
