<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pasien') }}
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
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                                <i class="fa-solid fa-hospital-user text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pasiens->total() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6 px-4 sm:px-6 lg:px-0">
                <h3 class="font-semibold text-lg text-gray-800">Manajemen Pasien</h3>
                <a href="{{ route('pasien.create') }}" class="inline-block px-3 py-1.5 bg-green-500 text-white text-xs md:text-sm font-semibold rounded-md hover:bg-green-600">
                    <i class="fa-solid fa-plus"></i> Tambah Pasien
                </a>
            </div>

            {{-- Form Search --}}
            <div class="mb-6 px-4 sm:px-6 lg:px-0">
                <form method="GET" class="w-full flex gap-4 justify-between">
                    <input type="text" name="search" placeholder="Cari pasien..." value="{{ request('search') }}" class="w-60 sm:w-80 px-6 py-1.5 border border-neutral-200 rounded-md" autocomplete="off" />
                    <button type="submit" class="px-4 py-2 text-xs md:text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Tabel Pasien --}}
            <div class="bg-white border border-neutral-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">No.</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor RM</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">NIK</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Tempat Lahir</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Lahir</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Jenis Kelamin</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Wilayah</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">No. HP</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pasiens as $pasien)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $loop->iteration + ($pasiens->currentPage() - 1) * $pasiens->perPage() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->no_rekam_medis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->nik }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->place_of_birth }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ \Carbon\Carbon::parse($pasien->date_of_birth)->translatedFormat('d F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->gender }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->wilayah->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $pasien->phone_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                        <a href="{{ route('kunjungan.create', $pasien) }}" class="inline-block px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-md hover:bg-green-600">
                                            <i class="fa-solid fa-plus"></i> Buat Kunjungan
                                        </a>

                                        <a href="{{ route('pasien.edit', $pasien) }}" class="inline-block px-3 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded-md hover:bg-blue-600">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('pasien.destroy', $pasien) }}" method="POST" class="inline-block" id="deleteForm-{{ $pasien->id }}" onclick="confirmDelete({{ $pasien->id }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="inline-block px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-md hover:bg-red-600">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="px-6 py-4 text-center text-gray-500">Data pasien tidak ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $pasiens->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(pasienId) {
            Swal.fire({
                title: 'Apakah kamu yakin?'
                , text: "Pasien ini akan dihapus secara permanen!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Ya, hapus!'
                , cancelButtonText: 'Batal'
                , reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + pasienId).submit();
                }
            });
        }

    </script>
    @endpush
</x-app-layout>
