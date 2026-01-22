<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Kegiatan;
use App\Models\User;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'judul_laporan',
        'bulan_laporan',
        'status',
        'catatan_admin', 
        'verified_by',
        'verified_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'nama_kegiatan', 'kegiatan_referensi');
    }
}
