@props(['color' => 'primary', 'size' => 'sm', 'soft' => true])

@php
    $flyonColors = [
        'primary' => 'badge-primary',
        'secondary' => 'badge-secondary',
        'danger' => 'badge-error',
        'success' => 'badge-success',
        'info' => 'badge-info',
        'warning' => 'badge-warning',
    ];

    $colorClass = $flyonColors[$color] ?? 'badge-primary';
    $softClass = $soft ? 'badge-soft' : '';
    $sizeClass = "text-{$size}";
@endphp

<span {{ $attributes->merge(['class' => "badge {$colorClass} {$softClass} {$sizeClass}"]) }}>
    {{ $slot }}
</span>
