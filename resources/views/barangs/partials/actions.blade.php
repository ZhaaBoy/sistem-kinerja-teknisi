<div class="flex items-center gap-2">
    <a href="{{ route('barangs.edit', $barang) }}">
        <x-button variant="primary" size="sm">
            <span class="icon-[tabler--pencil] size-4"></span>
        </x-button>
    </a>

    <form method="POST" action="{{ route('barangs.destroy', $barang) }}"
        onsubmit="return confirm('Yakin hapus barang ini?')">
        @csrf @method('DELETE')
        <x-button variant="danger" size="sm">
            <span class="icon-[tabler--trash] size-4"></span>
        </x-button>
    </form>
</div>
