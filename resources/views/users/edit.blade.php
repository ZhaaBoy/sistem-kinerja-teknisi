@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4">Edit User</h2>

        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Nama</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="input w-full border-gray-300 rounded-lg"
                    required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="input w-full border-gray-300 rounded-lg">
            </div>

            <div>
                <label>Role</label>
                <select name="role" class="select w-full border-gray-300 rounded-lg" required>
                    @foreach (['admin' => 'Admin', 'kepala_gudang' => 'Kepala Gudang', 'teknisi' => 'Teknisi', 'helper' => 'Helper'] as $value => $label)
                        <option value="{{ $value }}" @selected($user->role == $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <x-button variant="primary" type="submit">Update</x-button>
                <a href="{{ route('users.index') }}"><x-button variant="secondary">Kembali</x-button></a>
            </div>
        </form>
    </div>
@endsection
