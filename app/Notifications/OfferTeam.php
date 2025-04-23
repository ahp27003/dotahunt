<?php

namespace App\Notifications;

use App\Offer;
use App\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class OfferTeam extends Notification
{


    use Queueable;

    protected $offer, $team;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Offer $offer, Team $team)
    {
        $this->offer = $offer;
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

        //return ['database', 'broadcast', 'mail']; //close send email
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
            ->line('There are new offer to join Dota 2 Team from Team ' . $this->offer->team->name)
            ->action('View', url('/notifications'))
            ->line('Good luck, Have Fun!');
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
            'user_id' => $this->offer->user->id,
            'steam_name' => $this->offer->user->accounts->steam_name,
            'offer_id' => $this->offer->id,
            'dota_id' => $this->offer->user->accounts->dota_id,
            'offer_status' => $this->offer->status,
            'team_name' => $this->team->name,
            'team_id' => $this->team->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     $this->tournament
        // ]);

        return (new BroadcastMessage([
            'user_id' => $this->offer->user->id,
            'steam_name' => $this->offer->user->accounts->steam_name,
            'offer_id' => $this->offer->id,
            'dota_id' => $this->offer->user->accounts->dota_id,
            'offer_status' => $this->offer->status,
            'team_name' => $this->team->name,
            'team_id' => $this->team->id,
        ]))->onConnection('sync');
    }
}
