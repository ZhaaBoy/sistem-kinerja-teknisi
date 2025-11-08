@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- ✅ X-DATA dibungkus di level paling luar --}}
    <div x-data="{ showSuccess: false, showError: false, showUpdate: false }">

        {{-- GRID UTAMA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Example Card -->
            <div class="card bg-base-100 shadow p-6">
                <h2 class="text-lg font-semibold">Example Buttons</h2>
                <p class="text-sm text-gray-500 mb-3">Tombol dari komponen <code>&lt;x-button&gt;</code>:</p>

                <div class="flex flex-wrap gap-3">
                    {{-- ✅ Simpan --}}
                    <x-button variant="primary" auto-loading
                        x-on:click="
                            showSuccess = true;
                            setTimeout(() => showSuccess = false, 3000);
                        ">
                        Simpan Data
                    </x-button>

                    {{-- ❌ Hapus --}}
                    <x-button variant="danger" auto-loading
                        x-on:click="
                            showError = true;
                            setTimeout(() => showError = false, 3000);
                        ">
                        Hapus
                    </x-button>

                    {{-- 🔁 Update --}}
                    <x-button variant="success" auto-loading
                        x-on:click="
                            showUpdate = true;
                            setTimeout(() => showUpdate = false, 3000);
                        ">
                        Update
                    </x-button>
                </div>
            </div>

            <!-- Card Notifikasi -->
            <div class="card bg-base-100 shadow p-6 mt-6">
                <h2 class="text-lg font-semibold">Test Notifikasi Toast</h2>
                <p class="text-sm text-gray-500 mb-3">
                    Klik salah satu tombol di bawah untuk memunculkan toast di pojok kanan atas.
                </p>

                <div class="flex flex-wrap gap-3">
                    <x-button variant="primary"
                        x-on:click="$dispatch('notify', { type: 'success', message: 'Data berhasil disimpan!' })">
                        Tampilkan Success Toast
                    </x-button>

                </div>
            </div>

            <!-- Example Card -->
            <div class="card bg-base-100 shadow p-6">
                <h2 class="text-lg font-semibold">Example Badges</h2>
                <p class="text-sm text-gray-500 mb-3">Badge dari komponen <code>&lt;x-badge&gt;</code>:</p>

                <div class="flex flex-wrap gap-2">
                    <x-badge color="success" size="xs">Success</x-badge>
                    <x-badge color="info" size="xs">Info</x-badge>
                    <x-badge color="warning" size="xs">Warning</x-badge>
                    <x-badge color="danger" size="xs">Danger</x-badge>
                    <x-badge color="primary" :soft="false">Solid Primary</x-badge>
                </div>
            </div>

            <!-- Example Card -->
            <div class="card bg-base-100 shadow p-6">
                <h2 class="text-lg font-semibold">Example Nav Links</h2>
                <p class="text-sm text-gray-500 mb-3">Contoh <code>&lt;x-nav-link&gt;</code> untuk sidebar/menu:</p>

                <div class="flex flex-col gap-2">
                    <x-nav-link href="#" :active="true">
                        <span class="icon-[tabler--home] size-4.5"></span>
                        <span class="ml-2">Home (Active)</span>
                    </x-nav-link>

                    <x-nav-link href="#">
                        <span class="icon-[tabler--user] size-4.5"></span>
                        <span class="ml-2">Profile</span>
                    </x-nav-link>

                    <x-nav-link href="#">
                        <span class="icon-[tabler--settings] size-4.5"></span>
                        <span class="ml-2">Settings</span>
                    </x-nav-link>
                </div>
            </div>
        </div>

        <!-- Example Table -->
        <div class="card bg-base-100 shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Example Table Component</h2>

            <x-table :headers="['Name', 'Email', 'Status', 'Date', 'Actions']" :rows="[
                [
                    'John Doe',
                    'johndoe@example.com',
                    '<x-badge color=\'success\' size=\'xs\'>Professional</x-badge>',
                    'March 1, 2024',
                    '<x-button variant=\'primary\' size=\'sm\'><span class=\'icon-[tabler--pencil] size-4\'></span></x-button>
                                                                                                        <x-button variant=\'danger\' size=\'sm\'><span class=\'icon-[tabler--trash] size-4\'></span></x-button>',
                ],
                [
                    'Jane Smith',
                    'janesmith@example.com',
                    '<x-badge color=\'error\' size=\'xs\'>Rejected</x-badge>',
                    'March 2, 2024',
                    '<x-button variant=\'primary\' size=\'sm\'><span class=\'icon-[tabler--pencil] size-4\'></span></x-button>
                                                                                                        <x-button variant=\'danger\' size=\'sm\'><span class=\'icon-[tabler--trash] size-4\'></span></x-button>',
                ],
            ]" />
        </div>


    </div>
@endsection
