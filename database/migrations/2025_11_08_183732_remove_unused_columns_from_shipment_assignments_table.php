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
        Schema::table('shipment_assignments', function (Blueprint $table) {
            if (Schema::hasColumn('shipment_assignments', 'nama_barang')) {
                $table->dropColumn('nama_barang');
            }
            if (Schema::hasColumn('shipment_assignments', 'qty')) {
                $table->dropColumn('qty');
            }
            if (Schema::hasColumn('shipment_assignments', 'shipped_at')) {
                $table->dropColumn('shipped_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shipment_assignments', function (Blueprint $table) {
            $table->string('nama_barang')->nullable();
            $table->integer('qty')->nullable();
            $table->timestamp('shipped_at')->nullable();
        });
    }
};
