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
        Schema::create('marketing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade');
            $table->date('tanggal_pembelian');
            $table->string('tujuan_pembelian');
            $table->string('jenis_pembayaran');
            $table->string('keterangan_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketings', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('marketing');
    }
};
