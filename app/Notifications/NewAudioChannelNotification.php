<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Audio;

class NewAudioChannelNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $audio;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Audio $audio)
    {
        $this->audio = $audio;
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
                ->greeting('Channel "'.$this->audio->channel->name.'" baru saja menambahkan konten baru')
                ->line($this->audio->name)
                ->action('Lihat sekarang', url('/listen/'.$this->audio->slug))
                ->line('Terima kasih')
                ->line('Email ini dikirimkan kepada Anda karena Anda memilih untuk menerima update dari channel '.$this->audio->channel->name.'.');
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
