<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // nullable biar customer lama tetap aman
            $table->foreignId('barang_id')
                ->nullable()
                ->after('nama_pic')
                ->constrained('barangs')
                ->nullOnDelete(); // kalau barang dihapus, customer.barang_id jadi null
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropColumn('barang_id');
        });
    }
};
