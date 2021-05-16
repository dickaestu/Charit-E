<?php

namespace App\Notifications;

use App\PoskoModel\PermintaanBarang;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermintaanBarangVerified extends Notification
{
    use Queueable;
    public $permintaanBarang;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PermintaanBarang $permintaanBarang)
    {
        $this->permintaanBarang = $permintaanBarang;
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
            'id_permintaan_barang' => $this->permintaanBarang->id_permintaan_barang,
            'id_info_posko' => $this->permintaanBarang->id_info_posko,
            'keterangan_permintaan' => $this->permintaanBarang->keterangan_permintaan,
            'status_permintaan' => $this->permintaanBarang->status_permintaan,
            'status_pengiriman' => $this->permintaanBarang->status_pengiriman,
            'status_penerimaan' => $this->permintaanBarang->status_penerimaan,
            'tanggal_penerimaan' => $this->permintaanBarang->tanggal_penerimaan,
            'deleted_at' => $this->permintaanBarang->deleted_at,
            'created_at' => $this->permintaanBarang->created_at,
            'updated_at' => $this->permintaanBarang->updated_at
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'id_permintaan_barang' => $this->permintaanBarang->id_permintaan_barang,
            'id_info_posko' => $this->permintaanBarang->id_info_posko,
            'keterangan_permintaan' => $this->permintaanBarang->keterangan_permintaan,
            'status_permintaan' => $this->permintaanBarang->status_permintaan,
            'status_pengiriman' => $this->permintaanBarang->status_pengiriman,
            'status_penerimaan' => $this->permintaanBarang->status_penerimaan,
            'tanggal_penerimaan' => $this->permintaanBarang->tanggal_penerimaan,
            'created_at' => Carbon::now()->diffForHumans(),

        ];
    }

    public function broadcastOn()
    {
        return [
            new Channel('permintaanLogistikVerified')
        ];
    }
}
