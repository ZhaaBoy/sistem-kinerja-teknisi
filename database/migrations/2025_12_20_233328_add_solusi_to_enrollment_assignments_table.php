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
        Schema::table('enrollment_assignments', function (Blueprint $table) {
            $table->text('solusi')->nullable()->after('deskripsi_hasil');
        });
    }

    public function down(): void
    {
        Schema::table('enrollment_assignments', function (Blueprint $table) {
            $table->dropColumn('solusi');
        });
    }
};
