<?php

namespace App\Notifications;

use App\Models\Kegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class KegiatanStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Kegiatan $kegiatan,
        public readonly string   $status,   // 'approved' | 'revision' | 'rejected'
        public readonly string   $actorName,
        public readonly ?string  $notes = null,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $messages = [
            'approved' => "Laporan kegiatan \"{$this->kegiatan->nama_kegiatan}\" Anda telah **disetujui** oleh {$this->actorName}.",
            'revision'  => "Laporan kegiatan \"{$this->kegiatan->nama_kegiatan}\" memerlukan **revisi**. Catatan: {$this->notes}",
            'rejected'  => "Laporan kegiatan \"{$this->kegiatan->nama_kegiatan}\" Anda telah **ditolak** oleh {$this->actorName}.",
        ];

        $icons = [
            'approved' => 'check_circle',
            'revision'  => 'edit_note',
            'rejected'  => 'cancel',
        ];

        $colors = [
            'approved' => 'success',
            'revision'  => 'warning',
            'rejected'  => 'danger',
        ];

        $titles = [
            'approved' => 'Kegiatan Disetujui',
            'revision'  => 'Kegiatan Perlu Revisi',
            'rejected'  => 'Kegiatan Ditolak',
        ];

        return [
            'kegiatan_id'   => $this->kegiatan->id,
            'nama_kegiatan' => $this->kegiatan->nama_kegiatan,
            'status'        => $this->status,
            'title'         => $titles[$this->status] ?? 'Status Diperbarui',
            'message'       => $messages[$this->status] ?? "Status laporan Anda telah diperbarui.",
            'icon'          => $icons[$this->status] ?? 'info',
            'color'         => $colors[$this->status] ?? 'info',
            'actor_name'    => $this->actorName,
            'notes'         => $this->notes,
            'url'           => "/dashboards/kegiatans/{$this->kegiatan->id}/edit",
        ];
    }
}
