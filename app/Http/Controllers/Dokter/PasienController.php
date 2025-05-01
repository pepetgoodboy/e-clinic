<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pasiens = auth()->user()->pegawai
            ->kunjunganDokter()
            ->with('pasien')
            ->where('status', 'pendaftaran')
            ->when($search, function ($query, $search) {
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

            return view('dokter.pasien.index', compact('pasiens', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}
