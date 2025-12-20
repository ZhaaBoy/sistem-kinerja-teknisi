@extends('layouts.app')
@section('title', 'Tambah Penugasan')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl" x-data="searchCustomer()" x-init="init()">>

        <form method="POST" action="{{ route('penugasan-enrollment.store') }}" class="space-y-4">
            @csrf

            {{-- ===================== --}}
            {{--  SEARCH CUSTOMER     --}}
            {{-- ===================== --}}
            <div class="relative">
                <label class="block mb-1">Customer</label>

                <input type="text" x-ref="input" x-model="keyword" @input.debounce.300ms="onInput"
                    placeholder="Ketik nama customer..." class="input w-full border-gray-300 rounded-lg">

                <input type="hidden" name="customer_id" :value="selectedId">
                <input type="hidden" name="barang_id" :value="barangId">

                <ul x-show="open && results.length" @click.outside="open = false"
                    class="absolute z-50 bg-white shadow border w-full rounded-lg mt-1 max-h-52 overflow-y-auto">

                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)" class="px-3 py-2 cursor-pointer hover:bg-blue-100">
                            <div class="font-medium" x-text="item.nama_customer"></div>
                            <div class="text-xs text-gray-500"
                                x-text="item.nama_barang ? item.nama_barang + ' (' + item.kode_barang + ')' : '-'">
                            </div>
                        </li>
                    </template>
                </ul>
            </div>



            {{-- AUTO BARANG --}}
            <div>
                <label class="block mb-1 font-medium">Nama Barang</label>
                <input type="text" x-model="namaBarang" readonly class="input w-full border-gray-300 rounded-lg">
            </div>

            <div>
                <label class="block mb-1 font-medium">Kode Barang</label>
                <input type="text" x-model="kodeBarang" readonly class="input w-full border-gray-300 rounded-lg">
            </div>

            <x-input label="Qty" name="qty" type="number" min="1" required />
            <x-input label="Timeline (Deadline)" name="timeline" type="datetime-local" required />

            <div>
                <label class="block mb-1">Teknisi</label>
                <select name="teknisi_id" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="" hidden>Pilih teknisi</option>
                    @foreach ($teknisi as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" class="select w-full border-gray-300 rounded-lg" required>
                    <option value="mudah">Mudah</option>
                    <option value="menengah">Menengah</option>
                    <option value="sulit">Sulit</option>
                </select>
            </div>

            <div class="flex gap-3">
                <x-button type="submit" variant="primary" auto-loading>
                    Simpan
                </x-button>

                <x-button variant="secondary" href="{{ route('penugasan-enrollment.index') }}">
                    Kembali
                </x-button>
            </div>

        </form>
    </div>

    @push('scripts')
        <script>
            function searchCustomer() {
                return {
                    keyword: '',
                    results: [],
                    open: false,

                    selectedId: '',
                    barangId: '',
                    namaBarang: '',
                    kodeBarang: '',

                    init() {
                        this.$refs.input.addEventListener('focus', () => {
                            this.loadAll();
                            this.open = true;
                        });
                    },

                    onInput() {
                        if (!this.keyword.trim()) {
                            this.results = [];
                            this.open = false;
                            return;
                        }

                        this.search();
                    },

                    loadAll() {
                        fetch(`{{ route('api.customers.search') }}?q=`)
                            .then(r => r.json())
                            .then(d => {
                                this.results = d;
                                this.open = true;
                            });
                    },

                    search() {
                        fetch(`{{ route('api.customers.search') }}?q=${encodeURIComponent(this.keyword)}`)
                            .then(r => r.json())
                            .then(d => {
                                this.results = d;
                                this.open = true;
                            });
                    },

                    select(item) {
                        this.keyword = item.nama_customer;
                        this.selectedId = item.id;
                        this.barangId = item.barang_id;
                        this.namaBarang = item.nama_barang ?? '-';
                        this.kodeBarang = item.kode_barang ?? '-';

                        this.results = [];
                        this.open = false;
                    }
                }
            }
        </script>
    @endpush
@endsection
