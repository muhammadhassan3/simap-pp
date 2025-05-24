<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuan_proposal', function (Blueprint $table) {
            $table->decimal('harga', 20, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('pengajuan_proposal', function (Blueprint $table) {
            $table->integer('harga')->change(); // atau tipe sebelumnya
        });
    }
};
