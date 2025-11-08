@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card bg-base-100 shadow p-8 text-center">
        @php
            $role = auth()->user()->role ?? 'guest';
        @endphp

        @if ($role === 'admin')
            <h1 class="text-2xl font-bold text-primary">Dashboard Admin</h1>
            <p class="text-gray-600 mt-2">Selamat datang di panel administrator.</p>
        @elseif ($role === 'kepala_gudang')
            <h1 class="text-2xl font-bold text-info">Dashboard Kepala Gudang</h1>
            <p class="text-gray-600 mt-2">Selamat datang di sistem gudang.</p>
        @elseif ($role === 'teknisi')
            <h1 class="text-2xl font-bold text-success">Dashboard Teknisi</h1>
            <p class="text-gray-600 mt-2">Selamat datang di panel teknisi.</p>
        @elseif ($role === 'helper')
            <h1 class="text-2xl font-bold text-warning">Dashboard Helper</h1>
            <p class="text-gray-600 mt-2">Selamat datang di panel helper.</p>
        @else
            <h1 class="text-2xl font-bold text-gray-500">Dashboard Umum</h1>
        @endif
    </div>
@endsection
