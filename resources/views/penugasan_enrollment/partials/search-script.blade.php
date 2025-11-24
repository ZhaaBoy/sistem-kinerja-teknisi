<script>
    function searchCustomerEdit(id, name) {
        return {
            keyword: name,
            selectedId: id,
            results: [],

            search() {
                if (this.keyword.length < 2) {
                    this.results = [];
                    return;
                }
                fetch(`/api/search/customers?q=${this.keyword}`)
                    .then(r => r.json())
                    .then(d => this.results = d);
            },
            select(item) {
                this.keyword = item.nama_customer;
                this.selectedId = item.id;
                this.results = [];
            }
        }
    }

    function searchBarangEdit(id, name, kode) {
        return {
            keyword: name,
            selectedId: id,
            results: [],

            search() {
                if (this.keyword.length < 2) {
                    this.results = [];
                    return;
                }
                fetch(`/api/search/barangs?q=${this.keyword}`)
                    .then(r => r.json())
                    .then(d => this.results = d);
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
