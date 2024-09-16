<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Channel;

class ChannelUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $channel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
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
            ->greeting($this->channel->name.' baru saja di update oleh kreator')
            ->line($this->channel->name)
            ->action('Lihat sekarang', url('/channel/'.$this->channel->slug))
            ->line('Terima kasih')
            ->line('Email ini dikirimkan kepada Anda karena Anda memilih untuk menerima update dari '.$this->channel->name.'.');
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
