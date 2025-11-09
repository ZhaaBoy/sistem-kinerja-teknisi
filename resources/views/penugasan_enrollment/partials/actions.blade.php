<div class="flex gap-2">
    {{-- Kepala Gudang: Bisa edit sebelum selesai --}}
    @if (auth()->user()->role === \App\Models\User::ROLE_KEPALA_GUDANG &&
            !in_array($a->status, ['selesai', 'proses_packing']))
        <a href="{{ route('penugasan-enrollment.edit', $a) }}">
            <x-button size="sm" variant="info">
                <span class="icon-[tabler--edit] mr-1"></span> Edit
            </x-button>
        </a>
    @endif

    {{-- Teknisi: Input hasil jika masih dikerjakan --}}
    @if (auth()->user()->role === \App\Models\User::ROLE_TEKNISI && $a->status === 'dikerjakan_teknisi')
        <a href="{{ route('hasil-enrollment.create', $a) }}">
            <x-button size="sm" variant="success">
                <span class="icon-[tabler--check] mr-1"></span> Input Hasil
            </x-button>
        </a>
    @endif

    {{-- Helper: Selesai Packing --}}
    @if (auth()->user()->role === \App\Models\User::ROLE_HELPER && $a->status === 'proses_packing')
        <form method="POST" action="{{ route('hasil-enrollment.selesaiPacking', $a) }}">
            @csrf
            <x-button size="sm" variant="primary">
                <span class="icon-[tabler--package-check] mr-1"></span> Selesai Packing
            </x-button>
        </form>
    @endif
</div>
