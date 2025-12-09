@extends('layout')

@section('page_title', 'Tambah Kamar Baru')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Tambah Kamar Baru</h2>
        <p class="text-gray-500">Masukkan detail lengkap dan foto kamar hotel.</p>
    </div>

    <div class="bg-white p-8 shadow-lg rounded-xl">
        
        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="nama_kamar" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamar (e.g., Deluxe King, Suite)</label>
                <input type="text" id="nama_kamar" name="nama_kamar" value="{{ old('nama_kamar') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                @error('nama_kamar')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                    <select id="tipe_kamar" name="tipe_kamar" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">
                        <option value="">Pilih Tipe</option>
                        <option value="Single" {{ old('tipe_kamar') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Double" {{ old('tipe_kamar') == 'Double' ? 'selected' : '' }}>Double</option>
                        <option value="Suite" {{ old('tipe_kamar') == 'Suite' ? 'selected' : '' }}>Suite</option>
                    </select>
                    @error('tipe_kamar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga per Malam (IDR)</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3" min="0">
                    @error('harga')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok Kamar (Jumlah Unit Tersedia)</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3" min="0">
                    @error('stok')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Foto Kamar (Wajib)</label>
                    <input type="file" id="gambar" name="gambar" required accept="image/*"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    @error('gambar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kamar</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 p-3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('kamar.index') }}" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg shadow-md hover:bg-gray-300 transition duration-150">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150">
                    Simpan Kamar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
