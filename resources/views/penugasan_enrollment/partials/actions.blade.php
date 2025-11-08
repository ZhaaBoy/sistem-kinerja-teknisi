{{-- resources/views/penugasan_enrollment/partials/actions.blade.php --}}
<div class="flex gap-2">
    @if (auth()->user()->role === \App\Models\User::ROLE_KEPALA_GUDANG && $a->status !== 'selesai')
        <a href="{{ route('penugasan-enrollment.edit', $a) }}"><x-button size="sm">Edit</x-button></a>
    @endif

    @if (auth()->user()->role === \App\Models\User::ROLE_TEKNISI && $a->status !== 'selesai')
        <a href="{{ route('hasil-enrollment.create', $a) }}"><x-button size="sm" variant="success">Input
                Hasil</x-button></a>
    @endif
</div>
