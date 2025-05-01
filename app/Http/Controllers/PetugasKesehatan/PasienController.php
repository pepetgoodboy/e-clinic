<?php

namespace App\Http\Controllers\PetugasKesehatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePasienPetugasRequest;
use App\Http\Requests\UpdatePasienPetugasRequest;
use App\Models\Pasien;
use App\Models\Wilayah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pasiens = Pasien::with('wilayah')
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('petugas.pasien.index', compact('pasiens', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $wilayahs = Wilayah::all();
            $pasiens = Pasien::with('wilayah')->get();
            return view('petugas.pasien.create', compact('pasiens', 'wilayahs'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StorePasienPetugasRequest $request)
    {
        try {
            Pasien::create([
                'no_rekam_medis' => $request->no_rekam_medis,
                'nik' => $request->nik,
                'name' => $request->name,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d H:i:s'),
                'gender' => $request->gender,
                'address' => $request->address,
                'wilayah_id' => $request->wilayah_id,
                'phone_number' => $request->phone_number,
            ]);

            return redirect()->route('pasien.list')->with('success', 'Pasien berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function edit(Pasien $pasien)
    {
        try {
            $wilayahs = Wilayah::all();
            $pasiens = Pasien::with('wilayah')->get();
            return view('petugas.pasien.edit', compact('pasiens', 'pasien', 'wilayahs'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdatePasienPetugasRequest $request, Pasien $pasien)
    {
        try {
            $pasien->update([
                'no_rekam_medis' => $request->no_rekam_medis,
                'nik' => $request->nik,
                'name' => $request->name,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d H:i:s'),
                'gender' => $request->gender,
                'address' => $request->address,
                'wilayah_id' => $request->wilayah_id,
                'phone_number' => $request->phone_number,
            ]);

            return redirect()->route('pasien.list')->with('success', 'Pasien berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function destroy(Pasien $pasien)
    {
        try {
            $pasien->delete();
            return redirect()->route('pasien.list')->with('success', 'Pasien berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}
