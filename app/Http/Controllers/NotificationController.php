<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /** GET /dashboards/notifications — list notifikasi milik user yang login */
    public function index()
    {
        $user          = Auth::user();
        $notifications = $user->notifications()->latest()->take(30)->get()->map(function ($n) {
            return [
                'id'         => $n->id,
                'data'       => $n->data,
                'read_at'    => $n->read_at,
                'created_at' => $n->created_at->diffForHumans(),
            ];
        });

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }

    /** POST /dashboards/notifications/{id}/read — tandai satu notifikasi sebagai dibaca */
    public function markRead(string $id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // Tentukan URL redirect yang aman
        $data         = $notification->data;
        $originalUrl  = $data['url'] ?? null;
        $kegiatanId   = $data['kegiatan_id'] ?? null;

        // Jika notifikasi berisi kegiatan_id, cek apakah kegiatan masih ada
        if ($kegiatanId && $originalUrl) {
            $masihAda = Kegiatan::where('id', $kegiatanId)->exists();
            if (!$masihAda) {
                // Kegiatan sudah dihapus — arahkan ke daftar kegiatan
                return response()->json([
                    'ok'           => true,
                    'redirect_url' => '/dashboards/kegiatans',
                    'deleted'      => true,
                ]);
            }
        }

        return response()->json([
            'ok'           => true,
            'redirect_url' => $originalUrl,
            'deleted'      => false,
        ]);
    }

    /** POST /dashboards/notifications/read-all — tandai semua sebagai dibaca */
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['ok' => true]);
    }
}
