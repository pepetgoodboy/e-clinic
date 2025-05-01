<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-hospital-user text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pasiens->count() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pemeriksaan Pasien</span>
                            </div>
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

            <!-- Form Tambah -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                    <div class="text-red-600 bg-red-100 border border-red-300 p-4 rounded mb-4">
                        @foreach ($errors->all() as $error)
                        <p>- {{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <h3 class="font-semibold text-xl text-gray-800 mb-6 text-center">Periksa Pasien</h3>

                    <form method="POST" action="{{ route('dokter.pemeriksaan.store', $kunjungan->id) }}" class="w-full">
                        @csrf

                        <!-- Form Sections -->
                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Informasi Pribadi</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div>
                                    <label for="no_visit" class="block font-medium text-gray-700 mb-2">Nomor Kunjungan</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $kunjungan->no_visit }}</p>
                                </div>

                                <div>
                                    <label for="visit_date" class="block font-medium text-gray-700 mb-2">Tanggal Kunjungan</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ \Carbon\Carbon::parse($kunjungan->visit_date)->format('d F Y') }}</p>
                                </div>

                                <div>
                                    <label for="pasien_id" class="block font-medium text-gray-700 mb-2">Nama Pasien</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $kunjungan->pasien->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Informasi Penanganan</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="complaint" class="block font-medium text-gray-700 mb-2">Keluhan</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $kunjungan->complaint }}</p>
                                </div>

                                <div>
                                    <label for="diagnosis" class="block font-medium text-gray-700 mb-2">Diagnosis</label>
                                    <input type="text" name="diagnosis" id="diagnosis" value="{{ old('diagnosis') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="tindakan_id" class="block font-medium text-gray-700 mb-2">Tindakan</label>
                                    <select name="tindakan_id" id="tindakan_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        @foreach($tindakans as $tindakan)
                                        <option value={{ $tindakan->id }}>{{ $tindakan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="notes" class="block font-medium text-gray-700 mb-2">Catatan</label>
                                    <input type="text" name="notes" id="notes" value="{{ old('notes') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="rates" class="block font-medium text-gray-700 mb-2">Tarif</label>
                                    <input type="number" name="rates" id="rates" value="{{ old('rates') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div x-data="{ resep: [] }" class="mb-8" id="resep-obat">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Resep Obat</h4>
                            </div>

                            <template x-for="(item, index) in resep" :key="index">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nama Obat</label>
                                        <select :name="'obats['+index+'][id]'" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg">
                                            <option value="">Pilih Obat</option>
                                            @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" {{ $obat->stock == 0 ? 'disabled' : '' }}>
                                                {{ $obat->name }} {{ $obat->stock == 0 ? '(Stok habis)' : '' }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Jumlah</label>
                                        <input :name="'obats['+index+'][quantity]'" type="number" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg" placeholder="Jumlah">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Aturan Minum</label>
                                        <input :name="'obats['+index+'][notes]'" type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg" placeholder="Contoh: 3x1 setelah makan">
                                    </div>
                                </div>
                            </template>

                            <button type="button" @click="resep.push({})" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                + Tambah Obat
                            </button>
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tindakan = document.getElementById('tindakan_id');
            const formResep = document.getElementById('resep-obat');

            tindakan.addEventListener('change', function() {
                if (tindakan.value === '1') {
                    formResep.style.display = 'block';
                } else {
                    formResep.style.display = 'none';
                }
            });
        });

    </script>
    @endpush
</x-app-layout>
