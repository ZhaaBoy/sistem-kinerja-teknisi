@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4">Edit Customer</h2>

        <form method="POST" action="{{ route('customers.update', $customer) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Nama Customer</label>
                <input name="nama_customer" value="{{ old('nama_customer', $customer->nama_customer) }}"
                    class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Alamat</label>
                <textarea name="alamat" rows="3" class="textarea w-full border-gray-300 rounded-lg" required>{{ old('alamat', $customer->alamat) }}</textarea>
            </div>

            <div>
                <label>No Telpon</label>
                <input name="no_telpon" value="{{ old('no_telpon', $customer->no_telpon) }}"
                    class="input w-full border-gray-300 rounded-lg" type="number" required>
            </div>

            <div>
                <label>Nama PIC</label>
                <input name="nama_pic" value="{{ old('nama_pic', $customer->nama_pic) }}"
                    class="input w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3" class="textarea w-full border-gray-300 rounded-lg">{{ old('keterangan', $customer->keterangan) }}</textarea>
            </div>

            <div class="flex gap-3">
                <x-button variant="primary" type="submit">Update</x-button>

                <a href="{{ route('customers.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>
@endsection
