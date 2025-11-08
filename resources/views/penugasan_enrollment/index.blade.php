{{-- resources/views/penugasan_enrollment/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Penugasan Enrollment')
@section('content')
    <x-alert />
    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Penugasan Enrollment</h2>
            @if (auth()->user()->role === \App\Models\User::ROLE_KEPALA_GUDANG)
                <a href="{{ route('penugasan-enrollment.create') }}"><x-button variant="primary">
                        <span class="icon-[tabler--plus] mr-1"></span> Tambah
                    </x-button></a>
            @endif
        </div>

        @php
            $headers = ['Barang', 'Kode', 'Qty', 'Teknisi', 'Kesulitan', 'Poin', 'Status', 'Aksi'];
            $rows = $assignments
                ->map(function ($a) {
                    $aksi = view('penugasan_enrollment.partials.actions', compact('a'))->render();
                    return [
                        'barang' => e($a->nama_barang),
                        'kode' => e($a->kode_barang),
                        'qty' => $a->qty,
                        'teknisi' => e($a->teknisi->name ?? '-'),
                        'kes' => ucfirst($a->tingkat_kesulitan),
                        'poin' => $a->poin,
                        'status' =>
                            $a->status === 'selesai'
                                ? view('components.badge', [
                                    'color' => 'success',
                                    'soft' => true,
                                    'slot' => 'Selesai',
                                ])->render()
                                : view('components.badge', [
                                    'color' => 'warning',
                                    'soft' => true,
                                    'slot' => 'Dikerjakan',
                                ])->render(),
                        'aksi' => $aksi,
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />
        <div class="mt-4">{{ $assignments->links() }}</div>
    </div>
@endsection
