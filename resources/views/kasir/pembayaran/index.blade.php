<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                {{ session('error') }}
            </div>
            @endif

            <div class="flex mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-money-check-dollar text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pembayarans->total() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pembayaran Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6 px-4 sm:px-6 lg:px-0">
                <h3 class="font-semibold text-lg text-gray-800">Manajemen Pembayaran Pasien</h3>
            </div>

            {{-- Form Search --}}
            <div class="mb-6 px-4 sm:px-6 lg:px-0">
                <form method="GET" class="w-full flex gap-4 justify-between">
                    <input type="text" name="search" placeholder="Cari pembayaran..." value="{{ request('search') }}" class="w-60 sm:w-80 px-6 py-1.5 border border-neutral-200 rounded-md" autocomplete="off" />
                    <button type="submit" class="px-4 py-2 text-xs md:text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Tabel Pembayaran --}}
            <div class="bg-white border border-neutral-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">No.</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Kunjungan</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Kunjungan</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor RM</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Pasien</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Invoice</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Biaya Tindakan</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Biaya Obat</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Total Biaya</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pembayarans as $pembayaran)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $loop->iteration + ($pembayarans->currentPage() - 1) * $pembayarans->perPage() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pembayaran->kunjungan->no_visit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ \Carbon\Carbon::parse($pembayaran->kunjungan->visit_date)->translatedFormat('d F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pembayaran->kunjungan->pasien->no_rekam_medis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pembayaran->kunjungan->pasien->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pembayaran->no_invoice }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ \Illuminate\Support\Number::currency($pembayaran->total_tindakan, 'IDR', locale: 'id_ID') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ \Illuminate\Support\Number::currency($pembayaran->total_obat, 'IDR', locale: 'id_ID') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ \Illuminate\Support\Number::currency($pembayaran->subtotal, 'IDR', locale: 'id_ID') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center capitalize"><span class="px-2 py-1.5 rounded-md {{ $pembayaran->status == 'lunas' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">{{ $pembayaran->status }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500">Data pembayaran tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $pembayarans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
