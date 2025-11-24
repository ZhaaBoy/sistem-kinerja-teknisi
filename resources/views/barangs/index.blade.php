@extends('layouts.app')

@section('title', 'Manajemen Barang')

@section('content')
    @include('sweetalert::alert')

    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Daftar Barang</h2>
            <a href="{{ route('barangs.create') }}">
                <x-button variant="primary">
                    <span class="icon-[tabler--plus] mr-1"></span> Tambah Barang
                </x-button>
            </a>
        </div>

        @php
            $headers = ['Kode Barang', 'Nama Barang', 'Keterangan', 'Aksi'];

            $rows = $barangs
                ->map(function ($barang) {
                    return [
                        e($barang->kode_barang),
                        e($barang->nama_barang),
                        e($barang->keterangan ?? '-'),
                        view('barangs.partials.actions', compact('barang'))->render(),
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />

        {{-- Jika nanti ingin paginate --}}
        {{-- <div class="mt-4">{{ $barangs->links() }}</div> --}}
    </div>
@endsection
