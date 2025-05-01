<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'wilayah_id',
        'phone_number',
        'position',
        'specialization',
        'is_doctor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function detailTindakans()
    {
        return $this->hasMany(DetailTindakan::class, 'doctor_id');
    }

    public function kunjunganDokter()
    {
        return $this->hasMany(Kunjungan::class, 'doctor_id');
    }
}
