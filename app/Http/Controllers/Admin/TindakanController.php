<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTindakanRequest;
use App\Http\Requests\UpdateTindakanRequest;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $tindakans = Tindakan::query()
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('admin.tindakan.index', compact('tindakans', 'search'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $tindakans = Tindakan::all();
            return view('admin.tindakan.create', compact('tindakans'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StoreTindakanRequest $request)
    {
        try {
            Tindakan::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect()->route('tindakan.list')->with('success', 'Tindakan berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function edit(Tindakan $tindakan)
    {
        try {
            $tindakans = Tindakan::all();
            return view('admin.tindakan.edit', compact('tindakan', 'tindakans'));
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdateTindakanRequest $request, Tindakan $tindakan)
    {
        try {
            $tindakan->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect()->route('tindakan.list')->with('success', 'Tindakan berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }


    public function destroy(Tindakan $tindakan)
    {
        try {
            $tindakan->delete();
            return redirect()->route('tindakan.list')->with('success', 'Tindakan berhasil dihapus.');
        } catch(\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}