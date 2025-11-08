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
        Schema::create('shipment_assignments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('enrollment_assignment_id')->constrained()->cascadeOnDelete();
            $t->string('nama_barang');
            $t->unsignedInteger('qty');
            $t->string('no_resi')->nullable();
            $t->string('jasa_kirim')->nullable();
            $t->timestamp('shipped_at')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_assignments');
    }
};
