<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePemeriksaanRequest;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pasiens = auth()->user()->pegawai
            ->kunjunganDokter()
            ->with('pasien')
            ->where('status', 'proses pembayaran')
            ->when($search, function ($query, $search) {
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

            return view('dokter.pemeriksaan.index', compact('pasiens', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create(Kunjungan $kunjungan)
    {
        try {
            $pasiens = auth()->user()->pegawai
                ->kunjunganDokter()
                ->with('pasien')
                ->where('status', 'proses pembayaran')
                ->get();
            $tindakans = Tindakan::all();
            $obats = Obat::all();
            $kunjungan->load('pasien');

            $kunjungan->update([
                'status' => 'pemeriksaan'
            ]);

            return view('dokter.pemeriksaan.create', compact(['kunjungan', 'tindakans', 'obats', 'pasiens']));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StorePemeriksaanRequest $request, Kunjungan $kunjungan)
    {
        DB::beginTransaction();

        try {
            $doctorId = auth()->user()->pegawai->id;

            $kunjungan->update([
                'status' => 'proses pembayaran',
                'diagnosis' => $request->diagnosis,
            ]);

            $kunjungan->detailTindakan()->create([
                'kunjungan_id' => $kunjungan->id,
                'tindakan_id' => $request->tindakan_id,
                'doctor_id' => $doctorId,
                'notes' => $request->notes,
                'rates' => $request->rates
            ]);

            if ($request->has('obats')) {
                foreach ($request->obats as $obat) {
                    $kunjungan->resepObats()->create([
                        'kunjungan_id' => $kunjungan->id,
                        'obat_id' => $obat['id'],
                        'quantity' => $obat['quantity'],
                        'notes' => $obat['notes'],
                    ]);

                    $obatModel = Obat::find($obat['id']);
                    $obatModel->update([
                        'stock' => $obatModel->stock - $obat['quantity']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('dokter.pemeriksaan.list')->with('success', 'Pemeriksaan berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors($e->getMessage());
        }
    }
}