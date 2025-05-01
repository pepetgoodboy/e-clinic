<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function detailTindakans()
    {
        return $this->hasMany(DetailTindakan::class);
    }
}
