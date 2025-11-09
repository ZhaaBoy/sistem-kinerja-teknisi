@extends('layouts.app')
@section('title', 'Edit Penugasan')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-enrollment.update', $assignment->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <x-input label="Nama Customer" name="nama_customer" :value="$assignment->nama_customer" required />
            <x-input label="Nama Barang" name="nama_barang" :value="$assignment->nama_barang" required />
            <x-input label="Kode Barang" name="kode_barang" :value="$assignment->kode_barang" readonly />
            <x-input label="Qty" name="qty" type="number" min="1" :value="$assignment->qty" required />
            <x-input label="Timeline (Deadline)" name="timeline" type="datetime-local" :value="$assignment->timeline ? $assignment->timeline->format('Y-m-d\TH:i') : ''" required />

            <div>
                <label class="block mb-1">Teknisi</label>
                <select name="teknisi_id" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="" hidden>Pilih teknisi</option>
                    @foreach ($teknisi as $t)
                        <option value="{{ $t->id }}" {{ $t->id == $assignment->teknisi_id ? 'selected' : '' }}>
                            {{ $t->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="mudah" {{ $assignment->tingkat_kesulitan == 'mudah' ? 'selected' : '' }}>Mudah</option>
                    <option value="menengah" {{ $assignment->tingkat_kesulitan == 'menengah' ? 'selected' : '' }}>Menengah
                    </option>
                    <option value="sulit" {{ $assignment->tingkat_kesulitan == 'sulit' ? 'selected' : '' }}>Sulit</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Poin otomatis: Mudah=5, Menengah=10, Sulit=20</p>
            </div>

            <div class="flex gap-3">
                <x-button type="submit" variant="primary">Perbarui</x-button>
                <a href="{{ route('penugasan-enrollment.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>
@endsection
