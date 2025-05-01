<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKunjunganPetugasRequest;
use App\Http\Requests\UpdateKunjunganPetugasRequest;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $kunjungans = Kunjungan::with('pasien', 'petugas', 'dokter')
                ->when($search, function ($query, $search) {
                    $query->whereHas('pasien', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->paginate(10)
                ->withQueryString();

            return view('petugas.kunjungan.index', compact('kunjungans', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create(Pasien $pasien)
    {
        try {
            $dokters = Pegawai::where('position', 'Dokter')->get();
            $petugas_kesehatan = Pegawai::where('user_id', auth()->user()->id)
                                    ->where('position', 'Petugas Pendaftaran')
                                    ->first();
            $kunjungans = Kunjungan::with(['pasien','petugas','dokter'])->get();
            return view('petugas.kunjungan.create', compact('pasien', 'dokters', 'petugas_kesehatan', 'kunjungans'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StoreKunjunganPetugasRequest $request)
    {
        try {
            $petugas_kesehatan = Pegawai::where('user_id', auth()->user()->id)
                                    ->where('position', 'Petugas Pendaftaran')
                                    ->first();

            Kunjungan::create([
                'no_visit' => $request->no_visit,
                'visit_date' => Carbon::parse($request->visit_date)->format('Y-m-d H:i:s'),
                'pasien_id' => $request->pasien_id,
                'visit_type' => $request->visit_type,
                'complaint' => $request->complaint,
                'status' => 'pendaftaran',
                'pegawai_id' => $petugas_kesehatan->id,
                'doctor_id' => $request->doctor_id,
            ]);

            return redirect()->route('kunjungan.list')->with('success', 'Kunjungan berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function edit(Kunjungan $kunjungan)
    {
        try {
            $pasiens = Pasien::all();
            $dokters = Pegawai::where('position', 'Dokter')->get();

            $kunjungans = Kunjungan::with(['pasien','petugas','dokter'])->get();

            return view('petugas.kunjungan.edit', compact('kunjungans', 'kunjungan', 'pasiens', 'dokters'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdateKunjunganPetugasRequest $request, Kunjungan $kunjungan)
    {
        try {
            $kunjungan->update([
                'no_visit' => $request->no_visit,
                'visit_date' => Carbon::parse($request->visit_date)->format('Y-m-d H:i:s'),
                'visit_type' => $request->visit_type,
                'complaint' => $request->complaint,
                'doctor_id' => $request->doctor_id,
            ]);

            return redirect()->route('kunjungan.list')->with('success', 'Kunjungan berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function destroy(Kunjungan $kunjungan)
    {
        try {
            $kunjungan->delete();
            return redirect()->route('kunjungan.list')->with('success', 'Kunjungan berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}