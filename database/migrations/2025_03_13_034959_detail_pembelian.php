<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->enum('satuan', ['pcs', 'kg', 'ton', 'liter', 'box']);
            $table->integer('qty');
            $table->foreignId('id_pembelian')->references('id')->on('pembelian')->onDelete('cascade');
            $table->string('harga_satuan');
            $table->string('total_harga');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
