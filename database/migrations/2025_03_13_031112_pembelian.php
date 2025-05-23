<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('no_nota');
            $table->string('foto_nota');
            $table->timestamps();
        });
    }

    public function down(): void
    { 
        Schema::dropIfExists('pembelian');
    }
};
