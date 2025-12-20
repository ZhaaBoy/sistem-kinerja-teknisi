@extends('layouts.app')
@section('title', 'Edit Penugasan')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-enrollment.update', $assignment->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <x-input label="Customer" :value="$assignment->customer->nama_customer" readonly />

            <x-input label="Barang" :value="$assignment->barang->nama_barang" readonly />

            <x-input label="Kode Barang" :value="$assignment->barang->kode_barang" readonly />

            <x-input label="Qty" name="qty" type="number" min="1" :value="$assignment->qty" required />

            <x-input label="Timeline (Deadline)" name="timeline" type="datetime-local" :value="$assignment->timeline ? $assignment->timeline->format('Y-m-d\TH:i') : ''" required />

            {{-- Teknis --}}
            <div>
                <label class="block mb-1">Teknisi</label>
                <select name="teknisi_id" class="select w-full border-gray-300 rounded-lg">
                    @foreach ($teknisi as $t)
                        <option value="{{ $t->id }}" @selected($t->id == $assignment->teknisi_id)>
                            {{ $t->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kesulitan --}}
            <div>
                <label class="block mb-1">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" class="select w-full border-gray-300 rounded-lg">
                    <option value="mudah" @selected($assignment->tingkat_kesulitan == 'mudah')>Mudah</option>
                    <option value="menengah" @selected($assignment->tingkat_kesulitan == 'menengah')>Menengah</option>
                    <option value="sulit" @selected($assignment->tingkat_kesulitan == 'sulit')>Sulit</option>
                </select>
            </div>

            <div class="flex gap-3">
                <x-button type="submit" variant="primary">Perbarui</x-button>
                <a href="{{ route('penugasan-enrollment.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>

    {{-- Alpine Script --}}
    {{-- @push('scripts')
        @include('penugasan_enrollment.search-script')
    @endpush --}}

@endsection
