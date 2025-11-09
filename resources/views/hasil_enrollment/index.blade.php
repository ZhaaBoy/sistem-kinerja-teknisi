@extends('layouts.app')
@section('title', 'Hasil Enrollment')

@section('content')
    <x-alert />

    <div class="card bg-base-100 shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Daftar Hasil Pekerjaan Saya</h2>

        @php
            use Carbon\Carbon;

            $headers = ['Barang', 'Kode', 'Qty', 'Kesulitan', 'Poin', 'Deskripsi', 'Timeline', 'Status', 'Aksi'];

            $rows = $assignments
                ->map(function ($a) {
                    // Tombol aksi diambil dari partial agar bisa menyesuaikan role (teknisi/helper)
                    $aksi = view('hasil_enrollment.partials.actions', compact('a'))->render();

                    // Badge status
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

                    // Format timeline
                    $timeline = $a->timeline
                        ? (is_string($a->timeline)
                            ? Carbon::parse($a->timeline)->format('d M Y H:i')
                            : $a->timeline->format('d M Y H:i'))
                        : '-';

                    return [
                        'barang' => e($a->nama_barang),
                        'kode' => e($a->kode_barang),
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
