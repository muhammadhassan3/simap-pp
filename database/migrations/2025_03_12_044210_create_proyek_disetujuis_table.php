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
        Schema::create('proyek_disetujui', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_proposal')->constrained('pengajuan_proposal', 'id');
            $table->enum('status', ['Tersedia', 'Dikerjakan','Batal','Selesai'])->default('Tersedia');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_disetujui');
    }
};
