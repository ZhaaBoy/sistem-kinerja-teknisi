@extends('layouts.app')

@section('title', 'Tambah Customer')

@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Customer</h2>

        <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
            @csrf

            <div>
                <label>Nama Customer</label>
                <input name="nama_customer" value="{{ old('nama_customer') }}" class="input w-full border-gray-300 rounded-lg"
                    required>
                @error('nama_customer')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label>Alamat</label>
                <textarea name="alamat" rows="3" class="textarea w-full border-gray-300 rounded-lg" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label>No Telpon</label>
                <input name="no_telpon" value="{{ old('no_telpon') }}" class="input w-full border-gray-300 rounded-lg"
                    type="number" required>
                @error('no_telpon')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label>Nama PIC</label>
                <input name="nama_pic" value="{{ old('nama_pic') }}" class="input w-full border-gray-300 rounded-lg"
                    required>
                @error('nama_pic')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- ===================== --}}
            {{--  SEARCH BARANG       --}}
            {{-- ===================== --}}
            <div x-data="searchBarangCustomer()" x-init="init()" class="relative">
                <label class="block mb-1">Barang (berdasarkan Kelola Data Barang)</label>

                <input type="text" x-ref="input" x-model="keyword" @input.debounce.250ms="search"
                    placeholder="Ketik nama barang atau kode barang..." class="input w-full border-gray-300 rounded-lg">

                <input type="hidden" name="barang_id" x-model="selectedId">

                <ul x-show="results.length"
                    class="absolute z-50 bg-white shadow-lg border border-gray-300 w-full rounded-lg mt-1 max-h-52 overflow-y-auto">

                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)"
                            class="px-3 py-2 cursor-pointer transition-all duration-150 hover:bg-blue-100 hover:text-blue-700 flex items-center gap-2">
                            <span class="icon-[tabler--tag] text-gray-400"></span>

                            <div class="flex flex-col">
                                <span class="font-medium" x-text="item.nama_barang"></span>
                                <span class="text-xs text-gray-500" x-text="item.kode_barang"></span>
                            </div>
                        </li>
                    </template>

                </ul>

                @error('barang_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- kode_barang hanya tampilan, sumber dari hasil search --}}
            <div>
                <label>Kode Barang</label>
                <input id="kode_barang" class="input w-full border-gray-300 rounded-lg" readonly>
            </div>

            <div>
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3" class="textarea w-full border-gray-300 rounded-lg">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex gap-3">
                <x-button variant="primary" type="submit" auto-loading>Simpan</x-button>

                <a href="{{ route('customers.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function searchBarangCustomer() {
                return {
                    keyword: '',
                    results: [],
                    selectedId: '',

                    init() {
                        this.$refs.input.addEventListener('focus', () => {
                            this.loadAll();
                        });

                        this.$watch('keyword', value => {
                            if (!value || value.trim() === '') {
                                this.selectedId = '';
                                document.getElementById('kode_barang').value = '';
                            }
                        });
                    },

                    loadAll() {
                        fetch(`{{ route('api.barangs.search') }}?q=`)
                            .then(res => res.json())
                            .then(data => this.results = data);
                    },

                    search() {
                        fetch(`{{ route('api.barangs.search') }}?q=${encodeURIComponent(this.keyword)}`)
                            .then(res => res.json())
                            .then(data => this.results = data);
                    },

                    select(item) {
                        this.keyword = `${item.nama_barang} (${item.kode_barang})`;
                        this.selectedId = item.id;
                        document.getElementById('kode_barang').value = item.kode_barang;
                        this.results = [];
                    }
                }
            }
        </script>
    @endpush
@endsection
