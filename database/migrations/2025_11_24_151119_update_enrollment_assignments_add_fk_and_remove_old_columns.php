<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('enrollment_assignments', function (Blueprint $t) {

            // Tambah foreign keys
            $t->foreignId('customer_id')
                ->nullable()
                ->after('id')
                ->constrained('customers')
                ->nullOnDelete();

            $t->foreignId('barang_id')
                ->nullable()
                ->after('customer_id')
                ->constrained('barangs')
                ->nullOnDelete();

            // Hapus kolom lama
            $t->dropColumn(['nama_customer', 'nama_barang', 'kode_barang']);
        });
    }

    public function down(): void
    {
        Schema::table('enrollment_assignments', function (Blueprint $t) {
            $t->string('nama_customer')->nullable();
            $t->string('nama_barang')->nullable();
            $t->string('kode_barang')->nullable();

            $t->dropConstrainedForeignId('customer_id');
            $t->dropConstrainedForeignId('barang_id');
        });
    }
};
