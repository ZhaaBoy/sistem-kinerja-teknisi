@props([
    'type' => 'info',
    'title' => null,
    'message' => null,
    'toast' => true, // kalau true, tampil di pojok kanan atas
])

@php
    $styles = [
        'success' => [
            'icon' => 'icon-[tabler--check]',
            'bg' => 'bg-green-50 border border-green-200 text-green-800',
            'title' => 'Success Message',
        ],
        'error' => [
            'icon' => 'icon-[tabler--alert-triangle]',
            'bg' => 'bg-red-50 border border-red-200 text-red-800',
            'title' => 'Error Message',
        ],
        'warning' => [
            'icon' => 'icon-[tabler--alert-circle]',
            'bg' => 'bg-yellow-50 border border-yellow-200 text-yellow-800',
            'title' => 'Warning Message',
        ],
        'info' => [
            'icon' => 'icon-[tabler--info-circle]',
            'bg' => 'bg-blue-50 border border-blue-200 text-blue-800',
            'title' => 'Information',
        ],
    ];

    $style = $styles[$type] ?? $styles['info'];
    $title = $title ?? $style['title'];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 transform -translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-4" x-init="setTimeout(() => show = false, 4000)" @class([
        'flex items-start gap-3 p-4 rounded-xl shadow-md backdrop-blur-sm',
        $style['bg'],
        'fixed top-4 right-4 z-[9999] w-auto max-w-sm' => $toast,
        'relative w-full mb-4' => !$toast,
    ])>
    {{-- Icon --}}
    <div class="flex-shrink-0 mt-0.5">
        <span class="{{ $style['icon'] }} text-2xl"></span>
    </div>

    {{-- Text --}}
    <div class="flex-1">
        <h3 class="font-semibold text-base">{{ $title }}</h3>
        <p class="text-sm leading-relaxed text-gray-700/90">
            {{ $message }}
        </p>
    </div>

    {{-- Close button --}}
    <button type="button" x-on:click="show = false" class="ml-2 text-gray-500 hover:text-gray-700">
        <span class="icon-[tabler--x] text-lg"></span>
    </button>
</div>
