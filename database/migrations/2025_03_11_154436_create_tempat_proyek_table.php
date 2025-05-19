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
        Schema::create('tempat_proyek', function (Blueprint $table) {
            $table->id();
            $table->string("nama_tempat");
            $table->string("alamat");
            $table->string("foto");
            $table->integer("id_customer");
            $table->integer("id_kategori_proyek");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_proyek');
    }
};
