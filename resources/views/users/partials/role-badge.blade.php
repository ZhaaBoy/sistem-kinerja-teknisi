@php
    $map = [
        'admin' => ['color' => 'primary', 'text' => 'Admin'],
        'kepala_gudang' => ['color' => 'info', 'text' => 'Kepala Gudang'],
        'teknisi' => ['color' => 'success', 'text' => 'Teknisi'],
        'helper' => ['color' => 'warning', 'text' => 'Helper'],
    ];
    $cfg = $map[$user->role] ?? ['color' => 'secondary', 'text' => $user->role];
@endphp

<x-badge :color="$cfg['color']" size="xs">{{ $cfg['text'] }}</x-badge>
