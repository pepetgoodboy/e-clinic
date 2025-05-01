<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Pembayaran;
use App\Models\Tindakan;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $wilayah = Wilayah::count();
            $user = User::count();
            $pegawai = Pegawai::count();
            $tindakan = Tindakan::count();
            $obat = Obat::count();
            $pasien = Pasien::count();
            $kunjungan = Kunjungan::count();
            $pemeriksaan = Kunjungan::where('status', 'pemeriksaan')->count();
            $tagihan = Kunjungan::where('status', 'proses pembayaran')->count();
            $pembayaran = Pembayaran::where('status', 'lunas')->count();
            return view('dashboard', compact('wilayah', 'user', 'pegawai', 'tindakan', 'obat', 'pasien', 'kunjungan', 'pemeriksaan', 'tagihan', 'pembayaran'));
        } catch(Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function chartKunjungan()
    {
        $kunjungans = DB::table('kunjungans')
            ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as jumlah'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return response()->json($kunjungans);
    }

    public function chartObat()
    {
        $obats = DB::table('resep_obats')
            ->join('obats', 'resep_obats.obat_id', '=', 'obats.id')
            ->select('obats.name as nama', DB::raw('count(*) as jumlah'))
            ->groupBy('obats.name')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        return response()->json($obats);
    }
}