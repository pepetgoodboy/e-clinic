<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Card -->
            <div class="mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-red-100">
                                <i class="fa-solid fa-capsules text-red-500 text-2xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-3xl font-bold text-gray-800">{{ $obats->count() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Obat</span>
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
                        <h3 class="font-semibold text-xl text-gray-800">Tambah Obat</h3>
                    </div>

                    <form method="POST" action="{{ route('obat.store') }}" class="max-w-full">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Kode Obat -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Obat</label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Masukkan kode obat" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Nama Obat -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Obat</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama obat" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Deskripsi Obat -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Obat</label>
                                <input type="text" name="description" id="description" value="{{ old('description') }}" placeholder="Masukkan deskripsi obat" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Satuan -->
                            <div>
                                <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                                <select name="unit" id="unit" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none bg-white">
                                    <option value="tablet">Tablet</option>
                                    <option value="botol">Botol</option>
                                    <option value="ampul">Ampul</option>
                                </select>
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" placeholder="Masukkan stok obat" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
                            </div>

                            <!-- Harga -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="Masukkan harga obat" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" />
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
