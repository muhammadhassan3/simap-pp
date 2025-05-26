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
        Schema::create('pekerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_hp');
            $table->timestamps();
        });

        Schema::create('tempat_proyek', function (Blueprint $table) {
            $table->id();
            $table->string("nama_tempat");
            $table->string("alamat");
            $table->string("foto");
            $table->unsignedBigInteger("id_customer");
            $table->unsignedBigInteger("id_kategori_proyek");
            $table->timestamps();
        });
        Schema::create('pengajuan_proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tempat_proyek')->constrained('tempat_proyek', 'id');
            $table->string('file_proposal');
            $table->string('nama_proyek');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_pengajuan');
            $table->string('keterangan');
            $table->enum('status_proposal', ['Disetujui', 'Ditolak','Pending'])->default('pending');
            $table->timestamps();
        });
        Schema::create('proyek_disetujui', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan_proposal')->constrained('pengajuan_proposal', 'id');
            $table->enum('status', ['Tersedia', 'Dikerjakan','Batal','Selesai'])->default('Tersedia');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });
        Schema::create('tim_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project_disetujui'); // Tidak menggunakan foreign key
            $table->enum('peran', ['pekerja', 'pengawas', 'supervisor']);
            $table->unsignedBigInteger('id_pekerja'); // Tidak menggunakan foreign key
            $table->timestamps();
            $table->string('keahlian');
            $table->foreign('id_project_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
            $table->foreign('id_pekerja')->references('id')->on('pekerja')->onDelete('cascade');
        });
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('no_identitas',16)->unique();
            $table->string('nama_customer',40);
            $table->string('alamat',50);
            $table->string('no_hp',15);
            $table->string('email',50);
            $table->timestamps();
        });
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->decimal('harga', 10, 2);
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string(column: 'satuan', length: 50);
            $table->timestamps();
        });
        Schema::create('monitoring_proyek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyek_disetujui')->nullable();
            $table->unsignedBigInteger('id_penjadwalan')->nullable();
            $table->enum('status', ['Sudah Direview', 'Belum Direview'])->default('Belum Direview');
            $table->timestamps();
        });
        Schema::create('kategori_proyek', function (Blueprint $table) {
            $table->id();
//            $table->string('nama', ['produk', 'kontruksi']);
            $table->string('nama');
            $table->timestamps();
        });
        Schema::create('dokumen_penyelesaian_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek_disetujui')->constrained('proyek_disetujui')->onDelete('cascade');
            $table->string('file'); // Path file PDF
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
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
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('pekerjaan');
            $table->unsignedBigInteger('id_proyek_disetujui');
            $table->enum('status', ['tersedia', 'sedang dikerjakan', 'batal', 'selesai'])->default('tersedia');
            $table->foreignId('id_tim_project')->nullable()
                ->constrained('tim_project')
                ->cascadeOnDelete(); // Jika tim proyek dihapus, jadwalnya juga ikut terhapus
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign key ke tabel proyek_disetujui
            $table->foreign('id_proyek_disetujui')
                ->references('id')
                ->on('proyek_disetujui')
                ->onDelete('cascade');
        });
         Schema::create('pelaksanaan_proyek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjadwalan');
            $table->date('tanggal_pelaksanaan');
            $table->text('nama_pelaksanaan')->nullable();
            $table->string('foto')->nullable();
            $table->text('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::table('monitoring_proyek', function (Blueprint $table) {
            $table->foreign('id_proyek_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
            $table->foreign('id_penjadwalan')->references('id')->on('penjadwalan')->onDelete('cascade');
        });

        Schema::table('tempat_proyek', function (Blueprint $table) {
            $table->foreign('id_kategori_proyek')->references('id')->on('kategori_proyek')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
        });
        Schema::create('evaluasi_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek_disetujui')->constrained('proyek_disetujui','id');
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::table('kategori_proyek', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->after('nama'); // Menambahkan kolom "keterangan"
        });
        Schema::create('aktor', function (Blueprint $table) {
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('role');
        });
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek_disetujui')->references('id')->on('proyek_disetujui')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('no_nota');
            $table->string('foto_nota');
            $table->timestamps();
        });
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
        Schema::create('sewa_alat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->double('harga_sewa');
            $table->foreignId('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->integer('durasi');
            $table->foreignId('id_proyek')->references('id')->on('tempat_proyek')->onDelete('cascade');
            $table->integer('qty');
            $table->string('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropAllTables();
    }
};
