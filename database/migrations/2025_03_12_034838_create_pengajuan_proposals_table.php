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
        Schema::create('pengajuan_proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tempat_proyek')->constrained('tempat_proyek', 'id');
            $table->string('file_proposal');
            $table->string('nama_proyek');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_pengajuan');
            $table->string('keterangan');
            $table->enum('status_proposal', ['Disetujui', 'Ditolak','Pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_proposal');
    }
};
