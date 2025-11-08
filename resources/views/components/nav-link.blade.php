@props(['href', 'active' => false])

@php
    $classes = $active
        ? 'menu-item-active inline-flex items-center w-full p-2 text-sm font-medium text-primary bg-primary/10 rounded-lg'
        : 'inline-flex items-center w-full p-2 text-sm font-normal text-gray-700 hover:bg-base-200 rounded-lg transition';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
