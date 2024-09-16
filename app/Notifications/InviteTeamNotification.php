<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use App\Models\Team;

class InviteTeamNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user, $team;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
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
            ->greeting('New Team iSeeTalk')
            ->line('Halo '.$this->user->name.',')
            ->line('Pemberitahuan bahwa akun Anda telah mendapatkan undangan Team Member di iSeeTalk dengan informasi sebagai berikut:')
            ->line('ID : "'.$this->user->format_id.'"')
            ->line('Team Name : "'.$this->team->name.'"')
            ->line('Mulai kolaborasi bersama tim baru di iSeeTalk.')
            ->action('Login Sekarang', url('https://iseetalk.com/admin/team'))
            ->salutation("Terima Kasih");
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
            //
        ];
    }
}
