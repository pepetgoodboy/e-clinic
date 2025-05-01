<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
     public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $obats = Obat::query()
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('admin.obat.index', compact('obats', 'search'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $obats = Obat::all();
            return view('admin.obat.create', compact('obats'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StoreObatRequest $request)
    {
        try {
            Obat::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'stock' => $request->stock,
                'price' => $request->price
            ]);

            return redirect()->route('obat.list')->with('success', 'Obat berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }


    public function edit(Obat $obat)
    {
        try {
            $obats = Obat::all();
            return view('admin.obat.edit', compact('obat', 'obats'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdateObatRequest $request, Obat $obat)
    {
        try {
            $obat->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'stock' => $request->stock,
                'price' => $request->price
            ]);

            return redirect()->route('obat.list')->with('success', 'Obat berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }


    public function destroy(Obat $obat)
    {
        try {
            $obat->delete();
            return redirect()->route('obat.list')->with('success', 'Obat berhasil dihapus.');
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}
