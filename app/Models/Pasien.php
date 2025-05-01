<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    //
    protected $fillable = [
        'no_rekam_medis',
        'nik',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'wilayah_id',
        'phone_number',
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
