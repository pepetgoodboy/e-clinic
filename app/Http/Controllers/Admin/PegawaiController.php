<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Wilayah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pegawais = Pegawai::with('wilayah')
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('admin.pegawai.index', compact('pegawais', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $users = User::all();
            $wilayahs = Wilayah::all();
            $pegawais = Pegawai::with(['wilayah', 'user'])->get();
            return view('admin.pegawai.create', compact('pegawais', 'users', 'wilayahs'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StorePegawaiRequest $request)
    {
        try {
            Pegawai::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d H:i:s'),
                'address' => $request->address,
                'wilayah_id' => $request->wilayah_id,
                'phone_number' => $request->phone_number,
                'position' => $request->position,
                'specialization' => $request->specialization,
                'is_doctor' => $request->position == 'Dokter' ? 1 : 0,
            ]);

            return redirect()->route('pegawai.list')->with('success', 'Pegawai berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }



    public function edit(Pegawai $pegawai)
    {
        try {
            $users = User::all();
            $wilayahs = Wilayah::all();
            $pegawais = Pegawai::with(['wilayah', 'user'])->get();
            return view('admin.pegawai.edit', compact('pegawais', 'pegawai', 'users', 'wilayahs'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        try {
            $pegawai->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d H:i:s'),
                'address' => $request->address,
                'wilayah_id' => $request->wilayah_id,
                'phone_number' => $request->phone_number,
                'position' => $request->position,
                'specialization' => $request->specialization,
                'is_doctor' => $request->position == 'Dokter' ? 1 : 0,
            ]);

            return redirect()->route('pegawai.list')->with('success', 'Pegawai berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }


    public function destroy(Pegawai $pegawai)
    {
        try {
            $pegawai->delete();
            return redirect()->route('pegawai.list')->with('success', 'Pegawai berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}
