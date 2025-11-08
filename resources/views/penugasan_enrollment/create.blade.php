@extends('layouts.app')
@section('title', 'Tambah Penugasan')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-enrollment.store') }}" class="space-y-4">
            @csrf

            <x-input label="Nama Barang" name="nama_barang" required />
            <x-input label="Kode Barang" name="kode_barang" id="kode_barang" readonly />
            <x-input label="Qty" name="qty" type="number" min="1" required />

            <div>
                <label class="block mb-1">Teknisi</label>
                <select name="teknisi_id" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="" hidden>Pilih teknisi</option>
                    @foreach ($teknisi as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="mudah">Mudah</option>
                    <option value="menengah">Menengah</option>
                    <option value="sulit">Sulit</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Poin otomatis: Mudah=5, Menengah=10, Sulit=20</p>
            </div>

            <div class="flex gap-3">
                <x-button type="submit" variant="primary" auto-loading>Simpan</x-button>
                <a href="{{ route('penugasan-enrollment.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const rand = Math.floor(Math.random() * 9000) + 1000;
                const kode = `BRG-${rand}`;
                document.getElementById("kode_barang").value = kode;
            });
        </script>
    @endpush
@endsection
