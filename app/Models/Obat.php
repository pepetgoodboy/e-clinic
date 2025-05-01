<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'unit',
        'stock',
        'price',
    ];

    public function resepObat()
    {
        return $this->hasMany(ResepObat::class);
    }
}
