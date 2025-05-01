<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Card -->
            <div class="mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-purple-100">
                                <i class="fa-solid fa-users-gear text-purple-500 text-2xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-3xl font-bold text-gray-800">{{ $users->count() }}</span>
                                <span class="text-sm font-medium text-gray-600">Total Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="font-semibold text-xl text-gray-800">Edit User</h3>
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

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" name="name" id="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" value="{{ $user->name }}" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required autocomplete="off" value="{{ $user->email }}" />
                            </div>

                            <!-- Password (Optional for Edit) -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                    Password <span class="text-gray-500 text-xs">(Biarkan kosong jika tidak ingin mengubah)</span>
                                </label>
                                <input type="password" name="password" id="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" autocomplete="off" />
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" id="role" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none bg-white">
                                    <option value="Admin" {{ $user->hasRole('Admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="Dokter" {{ $user->hasRole('Dokter') ? 'selected' : '' }}>Dokter</option>
                                    <option value="Petugas Pendaftaran" {{ $user->hasRole('Petugas Pendaftaran') ? 'selected' : '' }}>Petugas Pendaftaran</option>
                                    <option value="Kasir" {{ $user->hasRole('Kasir') ? 'selected' : '' }}>Kasir</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="mt-8 flex justify-end gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center gap-2">
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
