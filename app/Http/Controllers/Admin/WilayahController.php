<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWilayahRequest;
use App\Http\Requests\UpdateWilayahRequest;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $wilayahs = Wilayah::query()
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('admin.wilayah.index', compact('wilayahs', 'search'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $wilayahs = Wilayah::all();
            return view('admin.wilayah.create', compact('wilayahs'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StoreWilayahRequest $request)
    {
        try {
            Wilayah::create([
                'name' => $request->name,
            ]);

            return redirect()->route('wilayah.list')->with('success', 'Wilayah berhasil ditambahkan.');
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function edit(Wilayah $wilayah)
    {
        try {
            $wilayahs = Wilayah::all();
            return view('admin.wilayah.edit', compact('wilayah', 'wilayahs'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdateWilayahRequest $request, Wilayah $wilayah)
    {
        try {
            $wilayah->update([
                'name' => $request->name,
            ]);

            return redirect()->route('wilayah.list')->with('success', 'Wilayah berhasil diupdate.');
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function destroy(Wilayah $wilayah)
    {
        try {
            $wilayah->delete();
            return redirect()->route('wilayah.list')->with('success', 'Wilayah berhasil dihapus.');
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}