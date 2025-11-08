{{-- resources/views/hasil_enrollment/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Hasil Enrollment')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h3 class="font-semibold mb-3">Input Hasil</h3>
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div><span class="text-gray-500">Barang:</span> <b>{{ $assignment->nama_barang }}</b></div>
            <div><span class="text-gray-500">Kode:</span> <b>{{ $assignment->kode_barang }}</b></div>
            <div><span class="text-gray-500">Qty:</span> <b>{{ $assignment->qty }}</b></div>
            <div><span class="text-gray-500">Kesulitan:</span> <b>{{ ucfirst($assignment->tingkat_kesulitan) }}
                    ({{ $assignment->poin }} pts)</b></div>
        </div>

        <form method="POST" action="{{ route('hasil-enrollment.store', $assignment) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1">Deskripsi Hasil</label>
                <textarea name="deskripsi_hasil" class="textarea w-full border-gray-300 rounded-lg" rows="5" required></textarea>
            </div>
            <div class="flex items-center gap-2">

                <x-button type="submit" variant="success" auto-loading>Selesaikan</x-button>
                <a href="{{ route('penugasan-enrollment.index') }}"><x-button variant="secondary">Batal</x-button></a>
            </div>
        </form>
    </div>
@endsection
