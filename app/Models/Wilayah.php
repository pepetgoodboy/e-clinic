<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    //
    protected $fillable = ['name'];

    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
