<?php

use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\TindakanController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dokter\PasienController as DokterPasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use App\Http\Controllers\Kasir\PembayaranController;
use App\Http\Controllers\Kasir\TagihanController;
use App\Http\Controllers\PetugasKesehatan\KunjunganController;
use App\Http\Controllers\PetugasKesehatan\PasienController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Route
Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    // Wilayah
    Route::get('admin/wilayah', [WilayahController::class, 'index'])->name('wilayah.list');
    Route::get('admin/wilayah/create', [WilayahController::class, 'create'])->name('wilayah.create');
    Route::post('admin/wilayah', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('admin/wilayah/{wilayah}/edit', [WilayahController::class, 'edit'])->name('wilayah.edit');
    Route::put('admin/wilayah/{wilayah}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::delete('admin/wilayah/{wilayah}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');

    // Users
    Route::get('/admin/users', [UsersController::class, 'index'])->name('users.list');
    Route::get('/admin/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/admin/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Pegawai
    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('pegawai.list');
    Route::get('/admin/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/admin/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/admin/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::patch('/admin/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/admin/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    // Tindakan
    Route::get('/admin/tindakan', [TindakanController::class, 'index'])->name('tindakan.list');
    Route::get('/admin/tindakan/create', [TindakanController::class, 'create'])->name('tindakan.create');
    Route::post('/admin/tindakan', [TindakanController::class, 'store'])->name('tindakan.store');
    Route::get('/admin/tindakan/{tindakan}/edit', [TindakanController::class, 'edit'])->name('tindakan.edit');
    Route::patch('/admin/tindakan/{tindakan}', [TindakanController::class, 'update'])->name('tindakan.update');
    Route::delete('/admin/tindakan/{tindakan}', [TindakanController::class, 'destroy'])->name('tindakan.destroy');

    // Obat
    Route::get('/admin/obat', [ObatController::class, 'index'])->name('obat.list');
    Route::get('/admin/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/admin/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/admin/obat/{obat}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::patch('/admin/obat/{obat}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/admin/obat/{obat}', [ObatController::class, 'destroy'])->name('obat.destroy');
});

// Petugas Kesehatan Route
Route::middleware(['auth', 'verified', 'role:Petugas Pendaftaran'])->group(function () {
    // Pasien
    Route::get('/petugas/pasien', [PasienController::class, 'index'])->name('pasien.list');
    Route::get('/petugas/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/petugas/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/petugas/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::patch('/petugas/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/petugas/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // Kunjungan
    Route::get('/petugas/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.list');
    Route::get('/petugas/kunjungan/{pasien}/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::post('/petugas/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
    Route::delete('/petugas/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
});

// Dokter Route
Route::middleware(['auth', 'verified', 'role:Dokter'])->group(function () {
    Route::get('/dokter/pasien', [DokterPasienController::class, 'index'])->name('dokter.pasien.list');
    Route::get('/dokter/pasien/{kunjungan}/periksa', [PemeriksaanController::class, 'create'])->name('dokter.periksa.create');
    Route::post('/dokter/pasien/{kunjungan}/periksa', [PemeriksaanController::class, 'store'])->name('dokter.pemeriksaan.store');
    Route::get('/dokter/pemeriksaan', [PemeriksaanController::class, 'index'])->name('dokter.pemeriksaan.list');
});

// Kasir Route
Route::middleware(['auth', 'verified', 'role:Kasir'])->group(function () {
    Route::get('/kasir/tagihan', [TagihanController::class, 'index'])->name('kasir.tagihan.list');
    Route::get('/kasir/tagihan/{kunjungan}/bayar', [PembayaranController::class, 'create'])->name('kasir.bayar.create');
    Route::post('/kasir/tagihan/{kunjungan}/bayar', [PembayaranController::class, 'store'])->name('kasir.pembayaran.store');
    Route::get('/kasir/pembayaran', [PembayaranController::class, 'index'])->name('kasir.pembayaran.list');
});

// Chart
Route::get('/chart-kunjungan', [DashboardController::class, 'chartKunjungan']);
Route::get('/chart-obat', [DashboardController::class, 'chartObat']);

require __DIR__.'/auth.php';