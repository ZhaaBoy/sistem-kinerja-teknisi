@extends('layouts.app')
@section('title', 'Tambah Pengiriman')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-pengiriman.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Pilih Penugasan (Selesai)</label>
                <select name="enrollment_assignment_id" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="" hidden>Pilih penugasan selesai</option>
                    @foreach ($selesai as $s)
                        <option value="{{ $s->id }}">
                            #{{ $s->id }} — {{ $s->nama_barang }} (qty: {{ $s->qty }})
                        </option>
                    @endforeach
                </select>
            </div>

            <x-input label="No Resi" name="no_resi" />
            <x-input label="Jasa Kirim" name="jasa_kirim" />

            <div class="flex gap-3">
                <x-button type="submit" variant="primary">Simpan</x-button>
                <a href="{{ route('penugasan-pengiriman.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>
@endsection
