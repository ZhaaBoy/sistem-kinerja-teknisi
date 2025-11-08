@extends('layouts.app')
@section('title', 'Daftar Pengiriman Barang')

@section('content')
    <x-alert />

    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Daftar Pengiriman Barang</h2>
            @if (auth()->user()->role === \App\Models\User::ROLE_KEPALA_GUDANG)
                <a href="{{ route('penugasan-pengiriman.create') }}">
                    <x-button variant="primary">
                        <span class="icon-[tabler--plus] mr-1"></span> Tambah
                    </x-button>
                </a>
            @endif
        </div>

        @php
            $headers = ['No', 'Barang', 'Qty', 'Teknisi', 'No Resi', 'Jasa Kirim', 'Aksi'];
            $rows = $shipments
                ->map(function ($ship, $i) {
                    $aksi = view('penugasan_pengiriman.partials.actions', compact('ship'))->render();
                    return [
                        $i + 1,
                        e($ship->penugasan->nama_barang ?? '-'),
                        e($ship->penugasan->qty ?? '-'),
                        e($ship->penugasan->teknisi->name ?? '-'),
                        e($ship->no_resi ?? '-'),
                        e($ship->jasa_kirim ?? '-'),
                        $aksi,
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />
        <div class="mt-4">{{ $shipments->links() }}</div>
    </div>
@endsection
