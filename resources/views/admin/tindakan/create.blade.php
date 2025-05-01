<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tindakan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Card -->
            <div class="mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-yellow-100">
                                <i class="fa-solid fa-notes-medical text-yellow-500 text-2xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-3xl font-bold text-gray-800">{{ $tindakans->count() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Tindakan</span>
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

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="font-semibold text-xl text-gray-800">Tambah Tindakan</h3>
                    </div>

                    <form method="POST" action="{{ route('tindakan.store') }}" class="max-w-full">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Kode Tindakan -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Tindakan</label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Masukkan kode tindakan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Nama Tindakan -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tindakan</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama tindakan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Deskripsi Tindakan -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Tindakan</label>
                                <input type="text" name="description" id="description" value="{{ old('description') }}" placeholder="Masukkan deskripsi tindakan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center gap-2 w-full max-w-xs">
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
