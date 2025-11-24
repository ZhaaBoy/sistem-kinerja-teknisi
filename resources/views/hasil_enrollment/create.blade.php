@extends('layouts.app')
@section('title', 'Hasil Enrollment')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- ========================= --}}
        {{--   CARD INFORMASI TUGAS   --}}
        {{-- ========================= --}}
        <div class="card bg-white shadow-xl rounded-2xl p-6 border border-gray-100">

            <div class="flex items-center gap-3 mb-4">
                <span class="icon-[tabler--info-circle] text-primary text-2xl"></span>
                <h2 class="text-xl font-semibold text-gray-800">Informasi Penugasan</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                {{-- Customer --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-start gap-3">
                    <span class=" text-gray-500 text-lg"></span>
                    <div>
                        <p class="text-gray-500 text-xs">Customer</p>
                        <p class="font-semibold text-gray-800">{{ $assignment->customer->nama_customer }}</p>
                    </div>
                </div>

                {{-- Barang --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-start gap-3">
                    <span class="icon-[tabler--package] text-gray-500 text-lg"></span>
                    <div>
                        <p class="text-gray-500 text-xs">Nama Barang</p>
                        <p class="font-semibold text-gray-800">{{ $assignment->barang->nama_barang }}</p>
                    </div>
                </div>

                {{-- Kode Barang --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-start gap-3">
                    <span class="icon-[tabler--barcode] text-gray-500 text-lg"></span>
                    <div>
                        <p class="text-gray-500 text-xs">Kode Barang</p>
                        <p class="font-semibold text-gray-800">{{ $assignment->barang->kode_barang }}</p>
                    </div>
                </div>

                {{-- Qty --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-start gap-3">
                    <span class="icon-[tabler--layers] text-gray-500 text-lg"></span>
                    <div>
                        <p class="text-gray-500 text-xs">Qty</p>
                        <p class="font-semibold text-gray-800">{{ $assignment->qty }}</p>
                    </div>
                </div>

                {{-- Kesulitan --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex items-start gap-3 sm:col-span-2">
                    <span class="icon-[tabler--alert-circle] text-gray-500 text-lg"></span>
                    <div>
                        <p class="text-gray-500 text-xs">Tingkat Kesulitan</p>
                        <p class="font-semibold capitalize text-gray-800">{{ $assignment->tingkat_kesulitan }}</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================= --}}
        {{--     FORM INPUT HASIL     --}}
        {{-- ========================= --}}
        <div class="card bg-white shadow-xl rounded-2xl p-6 border border-gray-100">

            <div class="flex items-center gap-3 mb-4">
                <span class="icon-[tabler--clipboard-text] text-primary text-2xl"></span>
                <h3 class="text-xl font-semibold text-gray-800">Input Hasil Pekerjaan</h3>
            </div>

            <form method="POST" action="{{ route('hasil-enrollment.store', $assignment) }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Deskripsi Hasil</label>
                    <textarea name="deskripsi_hasil" class="textarea textarea-bordered w-full rounded-xl focus:ring-2 focus:ring-primary/40"
                        rows="5" required></textarea>
                </div>

                <div class="flex gap-3 justify-end pt-3">
                    <x-button type="submit" variant="primary" auto-loading>
                        Simpan
                    </x-button>

                    <a href="{{ route('penugasan-enrollment.index') }}">
                        <x-button variant="secondary">Kembali</x-button>
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
