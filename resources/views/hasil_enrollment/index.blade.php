@extends('layouts.app')
@section('title', 'Hasil Enrollment')

@section('content')
    <x-alert />

    <div class="card bg-base-100 shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Daftar Penugasan Saya</h2>

        @php
            $headers = ['Barang', 'Kode', 'Qty', 'Kesulitan', 'Poin', 'Status', 'Aksi'];

            $rows = $assignments
                ->map(function ($a) {
                    // render partial actions pakai Blade view agar komponen <x-button> aktif penuh
                    $aksi = view('hasil_enrollment.partials.actions', compact('a'))->render();

                    $statusBadge =
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
                            ])->render();

                    return [
                        'barang' => e($a->nama_barang),
                        'kode' => e($a->kode_barang),
                        'qty' => $a->qty,
                        'kes' => ucfirst($a->tingkat_kesulitan),
                        'poin' => $a->poin,
                        'status' => $statusBadge,
                        'aksi' => $aksi,
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />
    </div>
@endsection
