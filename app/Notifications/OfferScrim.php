<?php

namespace App\Notifications;

use App\Scrimstatus;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class OfferScrim extends Notification
{
    use Queueable;

    protected $scrim;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Scrimstatus $scrim)
    {
        $this->scrim = $scrim;
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
        $date = Carbon::parse($this->scrim->date_time);

        return [
            'team_id' => $this->scrim->team->id,
            'team_name' => $this->scrim->team->name,
            'offer_id' => $this->scrim->id,
            'offer_status' => $this->scrim->status,
            'offer_time' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i:s a'),
            'offer_date' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y'),
            'notes' => $this->scrim->notes,
        ];
    }

    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     $this->tournament
        // ]);
        $date = Carbon::parse($this->scrim->date_time);
        return (new BroadcastMessage([
            'team_id' => $this->scrim->team->id,
            'team_name' => $this->scrim->team->name,
            'offer_id' => $this->scrim->id,
            'offer_status' => $this->scrim->status,
            'offer_time' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i:s a'),
            'offer_date' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y'),
        ]))->onConnection('sync');
    }
}
