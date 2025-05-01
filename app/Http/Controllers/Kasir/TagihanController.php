<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pasiens = Kunjungan::with('pasien')
            ->where('status', 'proses pembayaran')
            ->when($search, function ($query, $search) {
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

            return view('kasir.tagihan.index', compact('pasiens', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}