<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kategori_proyeks', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->after('nama'); // Menambahkan kolom "keterangan"
        });
    }

    public function down()
    {
        Schema::table('kategori_proyeks', function (Blueprint $table) {
            $table->dropColumn('keterangan'); // Menghapus kolom jika rollback
        });
    }
};
