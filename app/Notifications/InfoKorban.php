<?php

namespace App\Notifications;

use App\PoskoModel\InfoPosko;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InfoKorban extends Notification
{
    use Queueable;
    public $infoPosko;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(InfoPosko $infoPosko)
    {
        $this->infoPosko = $infoPosko;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            'id_info_posko' => $this->infoPosko->id_info_posko,
            'jumlah_korban' => $this->infoPosko->jumlah_korban,
            'jumlah_korban_jiwa' => $this->infoPosko->jumlah_korban_jiwa
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'id_info_posko' => $this->infoPosko->id_info_posko,
            'jumlah_korban' => $this->infoPosko->jumlah_korban,
            'jumlah_korban_jiwa' => $this->infoPosko->jumlah_korban_jiwa
        ];
    }

    public function broadcastOn()
    {
        return [
            new Channel('infoKorban')
        ];
    }
}
