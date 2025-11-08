@props([
    'type' => 'info',
    'message' => null,
    'toast' => false, // kalau true, tampil fixed di pojok kanan atas
])

@php
    $colors = [
        'success' => 'bg-green-600 text-white',
        'error' => 'bg-red-600 text-white',
        'warning' => 'bg-yellow-500 text-white',
        'info' => 'bg-blue-600 text-white',
    ];

    $icons = [
        'success' => 'icon-[tabler--check]',
        'error' => 'icon-[tabler--alert-triangle]',
        'warning' => 'icon-[tabler--alert-circle]',
        'info' => 'icon-[tabler--info-circle]',
    ];

    $colorClass = $colors[$type] ?? $colors['info'];
    $icon = $icons[$type] ?? $icons['info'];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition @class([
    // kalau toast = true → posisi fixed pojok kanan
    'fixed top-4 right-4 z-[9999] w-auto max-w-sm shadow-lg rounded-lg flex items-center gap-3 p-4',
    'relative w-full mb-4 rounded-lg flex items-center gap-3 p-4' => !$toast,
    $colorClass,
])>
    <span class="{{ $icon }} text-xl"></span>
    <span>{{ $message }}</span>

    <button x-on:click="show = false" class="ml-2 hover:text-gray-200">
        <span class="icon-[tabler--x] text-lg"></span>
    </button>
</div>
