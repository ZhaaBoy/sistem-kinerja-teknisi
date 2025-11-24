@extends('layouts.app')

@section('title', 'Manajemen Customer')

@section('content')
    @if (session('success'))
        <x-alert type="success" :message="session('success')" toast />
    @endif

    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Daftar Customer</h2>

            <a href="{{ route('customers.create') }}">
                <x-button variant="primary">
                    <span class="icon-[tabler--plus] mr-1"></span> Tambah Customer
                </x-button>
            </a>
        </div>

        @php
            $headers = ['Nama Customer', 'Alamat', 'No Telpon', 'PIC', 'Keterangan', 'Aksi'];

            $rows = $customers
                ->map(function ($customer) {
                    return [
                        e($customer->nama_customer),
                        e($customer->alamat),
                        e($customer->no_telpon),
                        e($customer->nama_pic),
                        e($customer->keterangan ?? '-'),
                        view('customers.partials.actions', compact('customer'))->render(),
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />

        {{-- Jika pakai paginate --}}
        {{-- <div class="mt-4">{{ $customers->links() }}</div> --}}
    </div>
@endsection
