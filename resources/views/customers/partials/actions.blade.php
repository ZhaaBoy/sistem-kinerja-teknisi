<div class="flex items-center gap-2">
    <a href="{{ route('customers.edit', $customer) }}">
        <x-button variant="primary" size="sm">
            <span class="icon-[tabler--pencil] size-4"></span>
        </x-button>
    </a>

    <form method="POST" action="{{ route('customers.destroy', $customer) }}"
        onsubmit="return confirm('Yakin hapus customer ini?')">
        @csrf @method('DELETE')
        <x-button variant="danger" size="sm">
            <span class="icon-[tabler--trash] size-4"></span>
        </x-button>
    </form>
</div>
