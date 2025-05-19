<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('pekerjaan');
            $table->unsignedBigInteger('id_proyek_disetujui');
            $table->enum('status', ['tersedia', 'sedang dikerjakan', 'batal', 'selesai'])->default('tersedia');
            $table->timestamps();

            // Foreign key ke tabel proyek_disetujui
            $table->foreign('id_proyek_disetujui')
                  ->references('id')
                  ->on('proyek_disetujui')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjadwalan');
    }
};