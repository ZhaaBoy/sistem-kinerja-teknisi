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
            $headers = [
                'Customer',
                'Barang',
                'Kode',
                'Qty',
                'Teknisi',
                'Kesulitan',
                'Permasalahan',
                'Solusi',
                'Timeline',
                'Poin',
                'Status',
                'Aksi',
            ];

            $rows = $assignments
                ->map(function ($a) {
                    return [
                        'customer' => e($a->customer->nama_customer ?? '-'),
                        'barang' => e($a->barang->nama_barang ?? '-'),
                        'kode' => e($a->barang->kode_barang ?? '-'),
                        'qty' => $a->qty,
                        'teknisi' => e($a->teknisi->name ?? '-'),
                        'kes' => ucfirst($a->tingkat_kesulitan),
                        'Permasalahan' => e(Str::limit($a->deskripsi_hasil ?? '-', 40)),
                        'solusi' => e(Str::limit($a->solusi ?? '-', 40)),
                        'timeline' => $a->timeline ? $a->timeline->format('d M Y H:i') : '-',
                        'poin' => $a->poin,
                        'status' => match ($a->status) {
                            'selesai' => view('components.badge', [
                                'color' => 'success',
                                'soft' => true,
                                'slot' => 'Selesai',
                            ])->render(),
                            'proses_packing' => view('components.badge', [
                                'color' => 'info',
                                'soft' => true,
                                'slot' => 'Proses Packing',
                            ])->render(),
                            default => view('components.badge', [
                                'color' => 'warning',
                                'soft' => true,
                                'slot' => 'Dikerjakan',
                            ])->render(),
                        },
                        'aksi' => view('penugasan_enrollment.partials.actions', ['a' => $a])->render(),
                    ];
                })
                ->toArray();

        @endphp

        <x-table :headers="$headers" :rows="$rows" />
        <div class="mt-4">{{ $assignments->links() }}</div>
    </div>
@endsection
