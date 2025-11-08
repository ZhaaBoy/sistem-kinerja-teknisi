<div class="flex gap-2">
    <a href="{{ route('penugasan-pengiriman.edit', $ship->id) }}">
        <x-button size="sm" variant="info">
            <span class="icon-[tabler--edit]"></span> Edit
        </x-button>
    </a>

    <form method="POST" action="{{ route('penugasan-pengiriman.destroy', $ship->id) }}"
        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <x-button size="sm" variant="error">
            <span class="icon-[tabler--trash]"></span> Hapus
        </x-button>
    </form>
</div>
