@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Barang</h2>

        <form method="POST" action="{{ route('barangs.store') }}" class="space-y-4">
            @csrf

            <div>
                <label>Kode Barang</label>
                <input name="kode_barang" value="{{ old('kode_barang') }}" class="input w-full border-gray-300 rounded-lg"
                    required>
            </div>

            <div>
                <label>Nama Barang</label>
                <input name="nama_barang" value="{{ old('nama_barang') }}" class="input w-full border-gray-300 rounded-lg"
                    required>
            </div>

            <div>
                <label>Keterangan</label>
                <textarea name="keterangan" class="textarea w-full border-gray-300 rounded-lg" rows="3">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex gap-3">
                <x-button variant="primary" type="submit" auto-loading>Simpan</x-button>
                <a href="{{ route('barangs.index') }}" class="">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>
@endsection
