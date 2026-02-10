<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'year',
        'kode_rekening',
        'nama_program',
        'kategori',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
