{{-- resources/views/hasil_enrollment/partials/actions.blade.php --}}
@if ($a->status === 'dikerjakan_teknisi')
    <a href="{{ route('hasil-enrollment.create', $a->id) }}">
        <x-button variant="success" size="sm" class="shadow-sm hover:shadow-md transition">
            </span> Selesaikan
        </x-button>
    </a>
@else
    <x-badge color="success" soft>Selesai</x-badge>
@endif
