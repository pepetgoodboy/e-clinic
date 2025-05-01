<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'no_invoice',
        'kunjungan_id',
        'total_tindakan',
        'total_obat',
        'subtotal',
        'status',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
