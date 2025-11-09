@extends('layouts.app')
@section('title', 'Laporan Enrollment')
@section('content')
    <x-alert />
    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Laporan Enrollment</h2>
        </div>

        @php
            use Carbon\Carbon;

            $headers = [
                'Customer',
                'Barang',
                'Kode',
                'Qty',
                'Teknisi',
                'Kesulitan',
                'Deskripsi',
                'Waktu Penyelesaian',
                'Status',
                'Aksi',
            ];

            $rows = $assignments
                ->map(function ($a) {
                    // Hitung durasi dari created_at ke completed_at
                    $durasi = $a->completed_at
                        ? $a->created_at->diff($a->completed_at)->format('%a Hari %h Jam %i Menit')
                        : '-';

                    $aksi = view('laporan_enrollment.partials.actions', compact('a'))->render();

                    return [
                        'customer' => e($a->nama_customer ?? '-'),
                        'barang' => e($a->nama_barang),
                        'kode' => e($a->kode_barang),
                        'qty' => $a->qty,
                        'teknisi' => e($a->teknisi->name ?? '-'),
                        'kes' => ucfirst($a->tingkat_kesulitan),
                        'deskripsi' => e(Str::limit($a->deskripsi_hasil ?? '-', 40)),
                        'waktu' => $durasi,
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
                        'aksi' => $aksi,
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />
        <div class="mt-4">{{ $assignments->links() }}</div>
    </div>
@endsection
