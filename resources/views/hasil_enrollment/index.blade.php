@extends('layouts.app')
@section('title', 'Hasil Enrollment')

@section('content')
    <x-alert />

    <div class="card bg-base-100 shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Daftar Hasil Pekerjaan Saya</h2>

        @php
            use Carbon\Carbon;

            $headers = [
                'Customer',
                'Barang',
                'Kode',
                'Qty',
                'Kesulitan',
                'Poin',
                'Deskripsi',
                'Timeline',
                'Status',
                'Aksi',
            ];

            $rows = $assignments
                ->map(function ($a) {
                    $aksi = view('hasil_enrollment.partials.actions', compact('a'))->render();

                    $statusBadge = match ($a->status) {
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
                    };

                    $timeline = $a->timeline
                        ? (is_string($a->timeline)
                            ? Carbon::parse($a->timeline)->format('d M Y H:i')
                            : $a->timeline->format('d M Y H:i'))
                        : '-';

                    return [
                        'customer' => e($a->customer->nama_customer ?? '-'),
                        'barang' => e($a->barang->nama_barang ?? '-'),
                        'kode' => e($a->barang->kode_barang ?? '-'),
                        'qty' => $a->qty,
                        'kes' => ucfirst($a->tingkat_kesulitan),
                        'poin' => $a->poin,
                        'deskripsi' => e(Str::limit($a->deskripsi_hasil ?? '-', 50)),
                        'timeline' => $timeline,
                        'status' => $statusBadge,
                        'aksi' => $aksi,
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />
        <div class="mt-4">{{ $assignments->links() }}</div>
    </div>
@endsection
