<x-error>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col justify-center items-center gap-4">
                    <img src="{{ asset('img/404.png') }}" alt="404" class="w-full max-w-xs h-auto mx-auto" />
                    <h2 class="text-2xl sm:text-3xl font-bold text-center">Halaman yang anda cari tidak ditemukan.</h2>
                    <p class="text-center text-sm sm:text-base font-medium px-4 sm:px-0">Silahkan kembali ke Dashboard untuk melanjutkan proses pelayanan.</p>
                    <a href="{{ route('dashboard') }}">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">Dashboard</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-error>
