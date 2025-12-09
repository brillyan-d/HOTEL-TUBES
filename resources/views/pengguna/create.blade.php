@extends('layout')

@section('page_title', 'Tambah Pengguna Baru')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h2>
        <p class="text-gray-500">Buat akun admin atau akun pengguna biasa.</p>
    </div>

    <div class="bg-white p-8 shadow-lg rounded-xl">
        
        <form action="{{ route('pengguna.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role Pengguna</label>
                <select id="role" name="role" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User Biasa</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('pengguna.index') }}" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 transition duration-150">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
