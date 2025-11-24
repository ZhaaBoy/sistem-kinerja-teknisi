@extends('layouts.app')
@section('title', 'Edit Penugasan')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-enrollment.update', $assignment->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- ===================== --}}
            {{--  SEARCH CUSTOMER     --}}
            {{-- ===================== --}}
            <div x-data="searchCustomerEdit('{{ $assignment->customer_id }}', '{{ $assignment->nama_customer }}')" class="relative">
                <label class="block mb-1">Customer</label>
                <input type="text" x-model="keyword" @input="search" class="input w-full border-gray-300 rounded-lg">
                <input type="hidden" name="customer_id" x-model="selectedId">

                <ul x-show="results.length"
                    class="absolute z-50 bg-white border border-gray-200 w-full rounded-lg mt-1 max-h-40 overflow-y-auto">
                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)" class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                            x-text="item.nama_customer"></li>
                    </template>
                </ul>
            </div>

            {{-- ===================== --}}
            {{--  SEARCH BARANG       --}}
            {{-- ===================== --}}
            <div x-data="searchBarangEdit('{{ $assignment->barang_id }}', '{{ $assignment->nama_barang }}', '{{ $assignment->kode_barang }}')" class="relative">
                <label class="block mb-1">Nama Barang</label>
                <input type="text" x-model="keyword" @input="search" class="input w-full border-gray-300 rounded-lg">
                <input type="hidden" name="barang_id" x-model="selectedId">

                <ul x-show="results.length"
                    class="absolute z-50 bg-white border border-gray-200 w-full rounded-lg mt-1 max-h-40 overflow-y-auto">
                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)" class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                            x-text="item.nama_barang"></li>
                    </template>
                </ul>
            </div>

            <x-input label="Kode Barang" name="kode_barang" id="kode_barang" :value="$assignment->kode_barang" readonly />

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
    @push('scripts')
        @include('penugasan_enrollment.search-script')
    @endpush

@endsection
