<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembayaranRequest;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pembayaran;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $pembayarans = Pembayaran::with('kunjungan')
            ->where('status', 'lunas')
            ->when($search, function ($query, $search) {
                $query->whereHas('kunjungan.pasien', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

            return view('kasir.pembayaran.index', compact('pembayarans', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
    public function create(Kunjungan $kunjungan)
    {
        try {
            $tindakans = Tindakan::all();
            $obats = Obat::all();
            $kunjungan->load('pasien');
            $total_tindakan = $kunjungan->detailTindakan()->sum('rates');
            $total_obat = $kunjungan->resepObats->sum(function ($item) {
                return ($item->obat->price ?? 0) * $item->quantity;
            });

            $pembayarans = Pembayaran::where('status', 'lunas')->get();

            if ($kunjungan->visit_type == 'bpjs') {
                $total_biaya = 0;
            } else {
                $total_biaya = $total_tindakan + $total_obat;
            }

            return view('kasir.pembayaran.create', compact(['kunjungan', 'tindakans', 'obats', 'total_tindakan', 'total_obat', 'total_biaya', 'pembayarans']));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StorePembayaranRequest $request, Kunjungan $kunjungan)
    {
        try {
            $no_invoice = substr(time() . rand(100, 999), 0, 8);

            Pembayaran::create([
                'no_invoice' => $no_invoice,
                'kunjungan_id' => $kunjungan->id,
                'total_tindakan' => $request->total_tindakan,
                'total_obat' => $request->total_obat,
                'subtotal' => $request->subtotal,
                'status' => $request->status
            ]);

            $kunjungan->update([
                'status' => 'selesai'
            ]);

            return redirect()->route('kasir.pembayaran.list')->with('success', 'Pembayaran berhasil ditambahkan');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}