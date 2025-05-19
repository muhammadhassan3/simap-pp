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
        Schema::create('monitoring_proyek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyek_disetujui')->nullable();
            $table->unsignedBigInteger('id_penjadwalan')->nullable();
            $table->enum('status', ['Sudah Direview', 'Belum Direview'])->default('Belum Direview');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_proyek');
    }
};
