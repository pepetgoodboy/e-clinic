<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $fillable = [
        'no_visit',
        'visit_date',
        'pasien_id',
        'visit_type',
        'complaint',
        'status',
        'pegawai_id',
        'doctor_id',
        'diagnosis',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Pegawai::class, 'doctor_id');
    }

    public function detailTindakan()
    {
        return $this->hasMany(DetailTindakan::class);
    }

    public function resepObats()
    {
        return $this->hasMany(ResepObat::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
