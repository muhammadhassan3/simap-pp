<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyek_disetujui', function (Blueprint $table) {
            // Drop foreign key lama
            $table->dropForeign(['id_pengajuan_proposal']);
            // Tambah foreign key baru dengan cascade
            $table->foreign('id_pengajuan_proposal')
                ->references('id')->on('pengajuan_proposal')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('proyek_disetujui', function (Blueprint $table) {
            $table->dropForeign(['id_pengajuan_proposal']);
            $table->foreign('id_pengajuan_proposal')
                ->references('id')->on('pengajuan_proposal');
                // tanpa cascade
        });
    }
};
