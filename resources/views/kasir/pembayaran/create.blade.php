<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-money-check-dollar text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pembayarans->count() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pembayaran Pasien</span>
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
                    <h3 class="font-semibold text-xl text-gray-800 mb-6 text-center">Pembayaran Tagihan Pasien</h3>

                    <form method="POST" action="#" class="w-full">
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
                                <h4 class="text-gray-700 font-medium">Informasi Pembayaran</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="visit_type" class="block font-medium text-gray-700 mb-2">Jenis Kunjungan</label>
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm {{ $kunjungan->visit_type == 'umum' ? 'capitalize' : 'uppercase' }}">{{ $kunjungan->visit_type }}</p>
                                </div>

                                <div>
                                    <label for="total_obat" class="block font-medium text-gray-700 mb-2">Biaya Obat</label>
                                    <input type="hidden" id="total_obat" name="total_obat" value="{{ $total_obat }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ \Illuminate\Support\Number::currency($total_obat, 'IDR', locale: 'id_ID') }}</p>

                                </div>

                                <div>
                                    <label for="total_tindakan" class="block font-medium text-gray-700 mb-2">Biaya Tindakan</label>
                                    <input type="hidden" id="total_tindakan" name="total_tindakan" value="{{ $total_tindakan }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ \Illuminate\Support\Number::currency($total_tindakan, 'IDR', locale: 'id_ID') }}</p>

                                </div>

                                <div>
                                    <label for="subtotal" class="block font-medium text-gray-700 mb-2">Total Biaya</label>
                                    <input type="hidden" id="subtotal" name="subtotal" value="{{ $total_biaya }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
                                    <p class="w-full px-4 py-2.5 bg-gray-200 text-gray-700 opacity-90 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ \Illuminate\Support\Number::currency($total_biaya, 'IDR', locale: 'id_ID') }}</p>

                                </div>

                                <div>
                                    <label for="status" class="block font-medium text-gray-700 mb-2">Status</label>
                                    <select name="status" id="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        <option value="belum lunas">Belum Lunas</option>
                                        <option value="lunas">Lunas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-10">
                            <button type="submit" class="px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm flex items-center gap-2 font-medium">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Bayar Sekarang</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
