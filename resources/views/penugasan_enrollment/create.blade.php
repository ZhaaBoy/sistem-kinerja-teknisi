@extends('layouts.app')
@section('title', 'Tambah Penugasan')
@section('content')
    <div class="card bg-base-100 shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('penugasan-enrollment.store') }}" class="space-y-4">
            @csrf

            {{-- ===================== --}}
            {{--  SEARCH CUSTOMER     --}}
            {{-- ===================== --}}
            <div x-data="searchCustomer()" class="relative">
                <label class="block mb-1">Customer</label>
                <input type="text" x-model="keyword" @input="search" placeholder="Ketik nama customer…"
                    class="input w-full border-gray-300 rounded-lg">
                <input type="hidden" name="customer_id" x-model="selectedId">

                <ul x-show="results.length"
                    class="absolute z-50 bg-white border border-gray-200 w-full rounded-lg mt-1 max-h-40 overflow-y-auto">
                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)" class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                            x-text="item.nama_customer"></li>
                    </template>
                </ul>
            </div>

            {{-- ===================== --}}
            {{--  SEARCH BARANG       --}}
            {{-- ===================== --}}
            <div x-data="searchBarang()" class="relative">
                <label class="block mb-1">Nama Barang</label>
                <input type="text" x-model="keyword" @input="search" placeholder="Ketik nama barang…"
                    class="input w-full border-gray-300 rounded-lg">
                <input type="hidden" name="barang_id" x-model="selectedId">

                <ul x-show="results.length"
                    class="absolute z-50 bg-white border border-gray-200 w-full rounded-lg mt-1 max-h-40 overflow-y-auto">
                    <template x-for="item in results" :key="item.id">
                        <li @click="select(item)" class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                            x-text="item.nama_barang"></li>
                    </template>
                </ul>
            </div>

            <x-input label="Kode Barang" name="kode_barang" id="kode_barang" readonly />

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
                <x-button type="submit" variant="primary" auto-loading>Simpan</x-button>
                <a href="{{ route('penugasan-enrollment.index') }}">
                    <x-button variant="secondary">Kembali</x-button>
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function searchCustomer() {
                return {
                    keyword: '',
                    results: [],
                    selectedId: '',

                    search() {
                        if (this.keyword.length < 2) {
                            this.results = [];
                            return;
                        }
                        fetch(`/api/search/customers?q=${this.keyword}`)
                            .then(res => res.json())
                            .then(data => this.results = data);
                    },

                    select(item) {
                        this.keyword = item.nama_customer;
                        this.selectedId = item.id;
                        this.results = [];
                    }
                }
            }

            function searchBarang() {
                return {
                    keyword: '',
                    results: [],
                    selectedId: '',

                    search() {
                        if (this.keyword.length < 2) {
                            this.results = [];
                            return;
                        }
                        fetch(`/api/search/barangs?q=${this.keyword}`)
                            .then(res => res.json())
                            .then(data => this.results = data);
                    },

                    select(item) {
                        this.keyword = item.nama_barang;
                        this.selectedId = item.id;
                        document.getElementById('kode_barang').value = item.kode_barang;
                        this.results = [];
                    }
                }
            }
        </script>
    @endpush
@endsection
