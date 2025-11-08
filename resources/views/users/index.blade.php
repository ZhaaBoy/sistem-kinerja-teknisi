@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    @if (session('message'))
        <x-alert :type="session('type', 'info')" :message="session('message')" toast />
    @endif

    <div class="card bg-base-100 shadow p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Daftar User</h2>
            <a href="{{ route('users.create') }}">
                <x-button variant="primary">
                    <span class="icon-[tabler--plus] mr-1"></span> Tambah User
                </x-button>
            </a>
        </div>

        @php
            $headers = ['Nama', 'Email', 'Role', 'Aksi'];
            $rows = $users
                ->map(function ($user) {
                    return [
                        e($user->name),
                        e($user->email),
                        view('users.partials.role-badge', compact('user'))->render(),
                        view('users.partials.actions', compact('user'))->render(),
                    ];
                })
                ->toArray();
        @endphp

        <x-table :headers="$headers" :rows="$rows" />

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
@endsection
