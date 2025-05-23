<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen_penyelesaian_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek_disetujui')->constrained('proyek_disetujui')->onDelete('cascade');
            $table->string('file'); // Path file PDF
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_penyelesaian_proyek');
    }
};
