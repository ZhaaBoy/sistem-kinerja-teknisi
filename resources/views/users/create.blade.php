@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4">Tambah User</h2>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf
            <div>
                <label>Nama</label>
                <input name="name" class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Role</label>
                <select name="role" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="admin">Admin</option>
                    <option value="kepala_gudang">Kepala Gudang</option>
                    <option value="teknisi">Teknisi</option>
                    <option value="helper">Helper</option>
                </select>
            </div>

            <div class="flex gap-3">
                <x-button variant="primary" type="submit" auto-loading>Simpan</x-button>
                <a href="{{ route('users.index') }}"><x-button variant="secondary">Kembali</x-button></a>
            </div>
        </form>
    </div>
@endsection
