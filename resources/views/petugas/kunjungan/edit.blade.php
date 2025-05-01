<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                            <i class="fa-solid fa-hospital-user text-green-500 text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold text-gray-800">{{ $kunjungans->count() }}</span>
                            <span class="text-sm font-medium text-gray-600">Edit Kunjungan</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Ups! Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Edit -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-xl text-gray-800 mb-6 text-center">Edit Kunjungan</h3>

                    <form method="POST" action="{{ route('kunjungan.update', $kunjungan->id) }}" class="w-full">
                        @csrf
                        @method('PATCH')

                        <!-- Form Sections -->
                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Informasi Pribadi</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div>
                                    <label for="no_visit" class="block font-medium text-gray-700 mb-2">Nomor Kunjungan</label>
                                    <input type="number" name="no_visit" id="no_visit" value="{{ $kunjungan->no_visit }}" placeholder="Masukkan nomor kunjungan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="visit_date" class="block font-medium text-gray-700 mb-2">Tanggal Kunjungan</label>
                                    <input type="date" name="visit_date" id="visit_date" value="{{ \Carbon\Carbon::parse($kunjungan->visit_date)->format('Y-m-d') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="pasien_id" class="block font-medium text-gray-700 mb-2">Nama Pasien</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $kunjungan->pasien->name }}</p>
                                </div>

                                <div>
                                    <label for="visit_type" class="block font-medium text-gray-700 mb-2">Jenis Kunjungan</label>
                                    <select name="visit_type" id="visit_type" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        <option value="umum" {{ $kunjungan->visit_type == 'umum' ? 'selected' : '' }}>Umum</option>
                                        <option value="bpjs" {{ $kunjungan->visit_type == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="complaint" class="block font-medium text-gray-700 mb-2">Keluhan</label>
                                    <input type="text" name="complaint" id="complaint" value="{{ $kunjungan->complaint }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Informasi Penanganan</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pegawai_id" class="block font-medium text-gray-700 mb-2">Nama Petugas</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $kunjungan->petugas->name }}</p>
                                </div>

                                <div>
                                    <label for="doctor_id" class="block font-medium text-gray-700 mb-2">Nama Dokter</label>
                                    <select name="doctor_id" id="doctor_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->id }}" {{ $kunjungan->doctor_id == $dokter->id ? 'selected' : '' }}>{{ $dokter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-10">
                            <button type="submit" class="px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm flex items-center gap-2 font-medium">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
