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
        Schema::create('enrollment_assignments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('kepala_gudang_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('teknisi_id')->constrained('users')->cascadeOnDelete();
            $t->string('nama_barang');
            $t->string('kode_barang');
            $t->unsignedInteger('qty');
            $t->enum('tingkat_kesulitan', ['mudah', 'menengah', 'sulit']);
            $t->unsignedSmallInteger('poin')->default(0);   // otomatis dari kesulitan
            $t->enum('status', ['dikerjakan_teknisi', 'selesai'])->default('dikerjakan_teknisi');
            $t->text('deskripsi_hasil')->nullable();        // diisi teknisi saat selesai
            $t->timestamp('completed_at')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_assignments');
    }
};
