<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wilayah') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                            <i class="fa-solid fa-chart-area text-blue-500 text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold text-gray-800">{{ $wilayahs->count() }}</span>
                            <span class="text-sm font-medium text-gray-600">Total Wilayah</span>
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
                    <h3 class="font-semibold text-lg text-gray-800 mb-6 text-center">Tambah Wilayah</h3>

                    <form method="POST" action="{{ route('wilayah.store') }}" class="max-w-2xl mx-auto">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-gray-700 mb-2">Nama Wilayah</label>
                            <div class="flex gap-3">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" placeholder="Masukkan nama wilayah" />
                                <button type="submit" class="px-5 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-sm flex items-center gap-2 font-medium">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
