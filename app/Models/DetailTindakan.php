<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTindakan extends Model
{
    protected $fillable = [
        'kunjungan_id',
        'tindakan_id',
        'doctor_id',
        'notes',
        'rates',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Pegawai::class);
    }
}