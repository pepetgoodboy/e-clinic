<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pasien') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
                            <i class="fa-solid fa-hospital-user text-blue-500 text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold text-gray-800">{{ $pasiens->count() }}</span>
                            <span class="text-sm font-medium text-gray-600">Total Pasien</span>
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
                    <h3 class="font-semibold text-xl text-gray-800 mb-6 text-center">Tambah Pasien</h3>

                    <form method="POST" action="{{ route('pasien.store') }}" class="w-full">
                        @csrf

                        <!-- Form Sections -->
                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Informasi Pribadi</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div>
                                    <label for="no_rekam_medis" class="block font-medium text-gray-700 mb-2">Nomor RM</label>
                                    <input type="number" name="no_rekam_medis" id="no_rekam_medis" value="{{ old('no_rekam_medis') }}" placeholder="Masukkan nomor rekam medis pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="nik" class="block font-medium text-gray-700 mb-2">NIK</label>
                                    <input type="number" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="name" class="block font-medium text-gray-700 mb-2">Nama</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="place_of_birth" class="block font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Masukkan tempat lahir pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="date_of_birth" class="block font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Masukkan tanggal lahir pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="gender" class="block font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="phone_number" class="block font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="number" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Masukkan nomor telepon pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="mb-5 pb-3 border-b border-gray-200">
                                <h4 class="text-gray-700 font-medium">Alamat & Lokasi</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="address" class="block font-medium text-gray-700 mb-2">Alamat</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Masukkan alamat pasien" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" required autocomplete="off" />
                                </div>

                                <div>
                                    <label for="wilayah_id" class="block font-medium text-gray-700 mb-2">Wilayah</label>
                                    <select name="wilayah_id" id="wilayah_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                        @foreach ($wilayahs as $wilayah)
                                        <option value="{{ $wilayah->id }}">{{ $wilayah->name }}</option>
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
