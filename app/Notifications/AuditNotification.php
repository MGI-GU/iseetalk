<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Audit;

class AuditNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $audit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Audit $audit)
    {
        $this->audit = $audit;
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
        if($this->audit->model_type === 'App\Models\Audio'){
            return (new MailMessage)
                ->greeting('Pembaruan konten oleh iSeeTalk Team')
                ->line('Konten anda '.$this->audit->audio->name.' baru saja di '.$this->audit->status.' oleh tim iSeeTalk')
                ->action('Lihat sekarang', url('/listen/'.$this->audit->audio->slug))
                ->line('Terima kasih sudah menggunakan aplikasi kami :)');
        }else{
            return (new MailMessage)
                ->greeting('Pembaruan konten oleh iSeeTalk Team')
                ->line('Channel anda '.$this->audit->channel->name.' baru saja di '.$this->audit->status.' oleh tim iSeeTalk')
                ->action('Lihat sekarang', url('/channel/'.$this->audit->channel->slug))
                ->line('Terima kasih sudah menggunakan aplikasi kami :)');
        }
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
