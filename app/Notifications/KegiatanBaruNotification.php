<?php

namespace App\Notifications;

use App\Models\Kegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class KegiatanBaruNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Kegiatan $kegiatan,
        public readonly string   $subbmitterName,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'kegiatan_id'   => $this->kegiatan->id,
            'nama_kegiatan' => $this->kegiatan->nama_kegiatan,
            'status'        => 'pending',
            'title'         => 'Kegiatan Baru Masuk',
            'message'       => "{$this->subbmitterName} menginput kegiatan baru: \"{$this->kegiatan->nama_kegiatan}\" dan menunggu persetujuan Anda.",
            'icon'          => 'assignment',
            'color'         => 'info',
            'actor_name'    => $this->subbmitterName,
            'notes'         => null,
            'url'           => "/dashboards/kegiatans/{$this->kegiatan->id}/edit",
        ];
    }
}
