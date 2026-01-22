<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Report;
use App\Models\User;

class Kegiatan extends Model
{
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
}
