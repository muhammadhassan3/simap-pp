<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration {
    public function up(): void {
        Schema::create('tim_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project_disetujui'); // Tidak menggunakan foreign key
            $table->enum('peran', ['pekerja', 'pengawas', 'supervisor']);
            $table->unsignedBigInteger('id_pekerja'); // Tidak menggunakan foreign key
            $table->timestamps();
            // $table->foreign('id_project_disetujui')->references('id')->on('project_disetujui')->onDelete('cascade');
            // $table->foreign('id_pekerja')->references('id')->on('pekerja')->onDelete('cascade');


            
        });
    }

    public function down(): void {
        Schema::dropIfExists('tim_project');
    }
};

