<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Kegiatan extends Model
{
    use LogsActivity;
    
    protected static function booted()
    {
        static::deleted(function ($kegiatan) {
            // Hapus notifikasi yang berkaitan dengan kegiatan ini saat kegiatannya dihapus
            DB::table('notifications')
                ->where('data->kegiatan_id', $kegiatan->id)
                ->delete();
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama_kegiatan', 'deskripsi', 'anggaran', 'status', 'catatan_revisi'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'deskripsi',
        'anggaran',
        'foto_sebelum',
        'foto_sesudah',
        'status',
        'verified_by',
        'verified_at',
        'latitude',
        'longitude',
        'catatan_revisi',
        'budget_id',
        'bulan',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
