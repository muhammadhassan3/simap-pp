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
        Schema::table('monitoring_proyek', function (Blueprint $table) {
            $table->foreign('id_proyek_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
            $table->foreign('id_penjadwalan')->references('id')->on('penjadwalan')->onDelete('cascade');
        });

        Schema::table('tim_proyek', function (Blueprint $table) {
            $table->foreign('id_pekerja')->references('id')->on('pekerja')->onDelete('cascade');
            $table->foreign('id_proyek_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
        });

        Schema::table('pengajuan_proposal', function (Blueprint $table) {
            $table->foreign('id_tempat_proyek')->references('id')->on('tempat_proyek')->onDelete('cascade');
        });

        Schema::table('proyek_disetujui', function (Blueprint $table) {
            $table->foreign('id_pengajuan_proposal')->references('id')->on('pengajuan_proposal')->onDelete('cascade');
        });

        Schema::table('tempat_proyek', function (Blueprint $table) {
            $table->foreign('id_kategori_proyek')->references('id')->on('kategori_proyek')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring_proyek', function (Blueprint $table) {
            $table->dropForeign(['id_proyek_disetujui']);
        });

        Schema::table('tim_proyek', function (Blueprint $table) {
            $table->dropForeign(['id_pekerja']);
            $table->dropForeign(['id_proyek_disetujui']);
        });

        Schema::table('pengajuan_proposal', function (Blueprint $table) {
            $table->dropForeign(['id_tempat_proyek']);
        });

        Schema::table('proyek_disetujui', function (Blueprint $table) {
            $table->dropForeign(['id_pengajuan_proposal']);
        });

        Schema::table('tempat_proyek', function (Blueprint $table) {
            $table->dropForeign(['id_kategori_proyek']);
            $table->dropForeign(['id_customer']);
        });
    }
};
