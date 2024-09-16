<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class UpdateUserNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->greeting('Update Akun iSeeTalk')
            ->line('Halo '.$this->user->name.',')
            ->line('Pemberitahuan bahwa akun Anda di iSeeTalk mendapatkan update terbaru dengan informasi sebagai berikut:')
            ->line('Saat ini akun ini berstatus "'.$this->user->status.'" dengan tipe "'.$this->user->type.'"')
            ->line('Silahkan mulai jelajahi iSeeTalk dengan update terbaru ini.')
            ->action('Login Sekarang', url('https://iseetalk.com/login'))
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
