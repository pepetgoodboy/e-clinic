<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="w-full h-80 bg-blue-500 rounded-[20px] bg-blend-multiply" style="background-image: url('/img/bg-hospital.jpg'); background-size: cover; background-position: center;">
                    <div class="w-full h-full flex flex-col gap-4 justify-center items-center">
                        <h2 class="text-2xl sm:text-3xl font-bold text-white">Selamat Datang <span class="font-semibold capitalize">{{ auth()->user()->name }}</span></h2>
                        <p class="text-white text-sm sm:text-base text-center font-medium px-4 sm:px-0">Silahkan pilih menu yang tersedia untuk melanjutkan proses pelayanan.</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">Logout</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 justify-center items-center mb-4">
                <div class="max-w-xl">
                    <canvas id="kunjunganChart"></canvas>
                </div>
                <div class="max-w-xs mx-auto">
                    <canvas id="obatChart"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <!-- Card Wilayah -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                                <i class="fa-solid fa-chart-area text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $wilayah }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Wilayah</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card User -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-purple-100">
                                <i class="fa-solid fa-users-gear text-purple-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $user }}</span>
                                <span class="text-sm font-medium text-gray-600">Total User</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Pegawai -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-users-gear text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pegawai }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pegawai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Tindakan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-yellow-100">
                                <i class="fa-solid fa-notes-medical text-yellow-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $tindakan }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Tindakan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Obat -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                                <i class="fa-solid fa-capsules text-red-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $obat }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Obat</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Pasien --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                                <i class="fa-solid fa-hospital-user text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pasien }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pasien</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Kunjungan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-hospital text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $kunjungan }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Kunjungan</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Tagihan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                                <i class="fa-solid fa-file-invoice-dollar text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $tagihan }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Tagihan</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card pemeriksaan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-hospital-user text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pemeriksaan }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pemeriksaan</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Pembayaran --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 h-full">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fa-solid fa-money-check-dollar text-green-500 text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-gray-800">{{ $pembayaran }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Pembayaran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        fetch('/chart-kunjungan')
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => {
                    const date = new Date(item.tanggal);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric'
                        , month: 'long'
                        , year: 'numeric'
                    });
                });

                const jumlah = data.map(item => item.jumlah);

                new Chart(document.getElementById('kunjunganChart'), {
                    type: 'bar'
                    , data: {
                        labels: labels
                        , datasets: [{
                            label: 'Jumlah Kunjungan Pasien'
                            , data: jumlah
                            , backgroundColor: 'rgba(54, 162, 235, 1)'
                            , borderRadius: 10
                            , barThickness: 30
                        }]
                    }
                    , options: {
                        scales: {
                            y: {
                                beginAtZero: true
                                , ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            });

        fetch('/chart-obat')
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => item.nama);
                const jumlah = data.map(item => item.jumlah);

                new Chart(document.getElementById('obatChart'), {
                    type: 'pie'
                    , data: {
                        labels: labels
                        , datasets: [{
                            label: 'Obat Terbanyak Diresepkan'
                            , data: jumlah
                            , backgroundColor: [
                                '#36A2EB'
                                , '#FF6384'
                                , '#FFCE56'
                                , '#4BC0C0'
                                , '#9966FF'
                            ]
                        }]
                    }
                });
            });

    </script>
    @endpush
</x-app-layout>
