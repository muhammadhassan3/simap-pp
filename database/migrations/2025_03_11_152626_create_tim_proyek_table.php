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
        Schema::create('tim_proyek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyek_disetujui');
            $table->enum('peran', ['pekerja', 'supervisor', 'pengawas']);
            $table->unsignedBigInteger('id_pekerja');
            $table->string('keahlian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim_proyek');
    }
};
