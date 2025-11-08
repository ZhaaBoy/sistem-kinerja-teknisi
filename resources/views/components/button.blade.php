@props([
    'variant' => 'primary',
    'size' => 'md',
    'outline' => false,
    'block' => false,
    'loading' => false,
    'disabled' => false,
    'autoLoading' => false,
])

@php
    $flyonVariants = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'danger' => 'btn-error',
        'success' => 'btn-success',
        'info' => 'btn-info',
        'warning' => 'btn-warning',
    ];

    $variantClass = $flyonVariants[$variant] ?? 'btn-primary';
    $sizes = [
        'sm' => 'btn-sm',
        'md' => 'btn-md',
        'lg' => 'btn-lg',
    ];

    $sizeClass = $sizes[$size] ?? 'btn-md';
    $blockClass = $block ? 'w-full' : '';
    $outlineClass = $outline ? 'btn-outline' : '';
    $disabledClass = $disabled ? 'opacity-60 cursor-not-allowed' : '';
@endphp

@if ($autoLoading)
    <button x-data="{ loading: false }"
        x-on:click="
            loading = true;
            $el.closest('form')?.submit();
        "
        x-bind:disabled="loading" type="{{ $attributes->get('type', 'submit') }}"
        {{ $attributes->merge([
            'class' => "btn {$variantClass} {$sizeClass} {$outlineClass} {$blockClass} {$disabledClass}",
        ]) }}>
        <template x-if="!loading">
            <span>{{ $slot }}</span>
        </template>
        <template x-if="loading">
            <span class="flex items-center gap-2">
                <span class="loading loading-spinner loading-sm"></span>
                Memproses...
            </span>
        </template>
    </button>
@else
    <button
        {{ $attributes->merge([
            'class' => "btn {$variantClass} {$sizeClass} {$outlineClass} {$blockClass} {$disabledClass}",
            'disabled' => $disabled || $loading,
        ]) }}>
        @if ($loading)
            <span class="loading loading-spinner mr-2"></span>
        @endif
        {{ $slot }}
    </button>
@endif
