<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat instance Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');

        // =========== 1. Users ===========
        $userIds = [];
        $roleArray = ['supervisor', 'staff', 'admin'];

        // Admin tetap - cek dulu apakah sudah ada
        if (!DB::table('users')->where('email', 'admin@gmail.com')->exists()) {
            DB::table('users')->insert([
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Staff tetap - cek dulu apakah sudah ada
        if (!DB::table('users')->where('email', 'staff@gmail.com')->exists()) {
            DB::table('users')->insert([
                'username' => 'Staff',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staff123'),
                'role' => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Generate 5 user tambahan acak
        for ($i = 0; $i < 5; $i++) {
            // Generate email unik yang belum ada di database
            do {
                $email = $faker->unique()->safeEmail();
            } while (DB::table('users')->where('email', $email)->exists());

            $userId = DB::table('users')->insertGetId([
                'username' => $faker->userName(),
                'email' => $email,
                'password' => Hash::make('password123'),
                'role' => $faker->randomElement($roleArray),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userIds[] = $userId;
        }

        // =========== 2. Kategori Proyek ===========
        $kategoriIds = [];
        $kategoriNama = ['Konstruksi Bangunan', 'Renovasi', 'Instalasi Listrik', 'Plumbing', 'Pemasangan Atap',
                         'Interior Design', 'Pengecatan', 'Landscaping', 'Perbaikan Jalan', 'Pembuatan Jembatan'];

        foreach ($kategoriNama as $nama) {
            $kategoriId = DB::table('kategori_proyek')->insertGetId([
                'nama' => $nama,
                'keterangan' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $kategoriIds[] = $kategoriId;
        }

        // =========== 3. Customer ===========
        $customerIds = [];

        for ($i = 0; $i < 15; $i++) {
            $customerId = DB::table('customer')->insertGetId([
                'no_identitas' => $faker->unique()->numerify('##############'),
                'nama_customer' => substr($faker->name(), 0, 40), // Nama customer maksimal 40 karakter
                'alamat' => substr($faker->address(), 0, 50), // Membatasi alamat maksimal 50 karakter
                'no_hp' => substr($faker->numerify('08##########'), 0, 15), // Pastikan nomor telepon tidak melebihi 15 karakter
                'email' => $faker->unique()->safeEmail(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $customerIds[] = $customerId;
        }

        // =========== 4. Pekerja ===========
        $pekerjaIds = [];
        $namaPekerja = ['Ahmad Wahyudi', 'Budi Santoso', 'Citra Lestari', 'Dewi Anggraini',
                        'Eko Prasetyo', 'Ferdi Nugroho', 'Gita Puspita', 'Hendra Wijaya',
                        'Indra Kusuma', 'Joko Widodo', 'Kartika Sari', 'Lukman Hakim',
                        'Maya Indah', 'Nanda Putri', 'Oscar Pradana', 'Putri Rahayu',
                        'Rudi Hartono', 'Siti Nurhaliza', 'Tono Sucipto', 'Udin Sedunia'];

        foreach ($namaPekerja as $nama) {
            $pekerjId = DB::table('pekerja')->insertGetId([
                'nama' => $nama,
                'no_hp' => substr($faker->numerify('08##########'), 0, 15), // Format nomor telepon Indonesia yang lebih pendek
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $pekerjaIds[] = $pekerjId;
        }

        // =========== 5. Tempat Proyek ===========
        $tempatProyekIds = [];
        $namaTempatProyek = [
            'Perumahan Griya Indah', 'Apartemen Skyline', 'Mall Grand Center',
            'Kantor Pusat BNI', 'Hotel Pesona', 'Gedung Sekolah Dasar Negeri 1',
            'Rumah Sakit Medika', 'Stadion Olahraga', 'Terminal Bus Kota',
            'Bandara Internasional', 'Gedung Perkantoran Megah', 'Universitas Teknologi',
            'Pabrik Manufaktur', 'Taman Kota', 'Restoran Mewah'
        ];

        for ($i = 0; $i < 15; $i++) {
            $tempatProyekId = DB::table('tempat_proyek')->insertGetId([
                'nama_tempat' => $faker->randomElement($namaTempatProyek) . ' ' . $faker->city(),
                'alamat' => substr($faker->address(), 0, 50), // Membatasi alamat maksimal 50 karakter
                'foto' => 'project_' . ($i+1) . '.jpg',
                'id_customer' => $faker->randomElement($customerIds),
                'id_kategori_proyek' => $faker->randomElement($kategoriIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $tempatProyekIds[] = $tempatProyekId;
        }

        // =========== 6. Pengajuan Proposal ===========
        $pengajuanProposalIds = [];
        $namaProyek = [
            'Pembangunan Gedung Utama', 'Renovasi Lantai 3', 'Penambahan Ruang Meeting',
            'Perbaikan Sistem Drainase', 'Instalasi Jaringan Listrik', 'Pengecatan Ulang Fasad',
            'Pemasangan CCTV', 'Pembuatan Taman Depan', 'Perbaikan Plafon', 'Renovasi Toilet',
            'Pembangunan Garasi', 'Penambahan Ruang Kerja', 'Perbaikan Pagar Keliling'
        ];
        $statusProposal = ['Disetujui', 'Ditolak', 'Pending'];

        for ($i = 0; $i < 10; $i++) {
            $tanggalPengajuan = $faker->dateTimeBetween('-1 year', 'now');
            $pengajuanProposalId = DB::table('pengajuan_proposal')->insertGetId([
                'id_tempat_proyek' => $faker->randomElement($tempatProyekIds),
                'file_proposal' => 'proposal_' . ($i+1) . '.pdf',
                'nama_proyek' => $faker->randomElement($namaProyek),
                'harga' => $faker->randomFloat(2, 10000, 9999999.99), // Nilai dalam range decimal(10,2)
                'tanggal_pengajuan' => $tanggalPengajuan,
                'keterangan' => substr($faker->sentence(), 0, 255), // String yang lebih pendek
                'status_proposal' => $faker->randomElement($statusProposal),
                'created_at' => Carbon::instance($tanggalPengajuan),
                'updated_at' => now(),
            ]);
            $pengajuanProposalIds[] = $pengajuanProposalId;
        }

        // =========== 7. Proyek Disetujui ===========
        // Hanya yang status proposal = Disetujui
        $proyekDisetujuiIds = [];
        $statusProyek = ['Tersedia', 'Dikerjakan', 'Batal', 'Selesai'];

        // Ambil dulu ID pengajuan proposal yang disetujui
        $pengajuanDisetujui = DB::table('pengajuan_proposal')
                               ->where('status_proposal', 'Disetujui')
                               ->pluck('id');

        // Jika tidak ada yang disetujui, ubah status beberapa proposal menjadi disetujui
        if ($pengajuanDisetujui->isEmpty()) {
            // Ubah status 5 pengajuan proposal menjadi Disetujui
            for ($i = 0; $i < 5; $i++) {
                if (isset($pengajuanProposalIds[$i])) {
                    DB::table('pengajuan_proposal')
                      ->where('id', $pengajuanProposalIds[$i])
                      ->update(['status_proposal' => 'Disetujui']);
                    $pengajuanDisetujui->push($pengajuanProposalIds[$i]);
                }
            }
        }

        // Buat proyek disetujui untuk pengajuan yang disetujui
        foreach ($pengajuanDisetujui as $idPengajuan) {
            $status = $faker->randomElement($statusProyek);
            $tanggalMulai = $faker->dateTimeBetween('-6 months', 'now');
            $tanggalSelesai = null;

            if ($status == 'Selesai') {
                $tanggalSelesai = $faker->dateTimeBetween(Carbon::instance($tanggalMulai), 'now');
            } else if ($status == 'Dikerjakan') {
                $tanggalSelesai = $faker->dateTimeBetween('+1 month', '+6 months');
            }

            $proyekDisetujuiId = DB::table('proyek_disetujui')->insertGetId([
                'id_pengajuan_proposal' => $idPengajuan,
                'status' => $status,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'created_at' => Carbon::instance($tanggalMulai),
                'updated_at' => now(),
            ]);
            $proyekDisetujuiIds[] = $proyekDisetujuiId;
        }

        // =========== 8. Tim Project ===========
        $timProjectIds = [];
        $peranTim = ['pekerja', 'pengawas', 'supervisor'];
        $keahlian = ['Tukang Batu', 'Tukang Kayu', 'Tukang Cat', 'Tukang Listrik', 'Arsitek',
                     'Tukang Las', 'Pengawas Keamanan', 'Insinyur Sipil', 'Desainer Interior',
                     'Tukang Keramik', 'Tukang Pipa', 'Operator Alat Berat', 'Quality Control'];

        // Untuk setiap proyek disetujui, buat tim proyek
        foreach ($proyekDisetujuiIds as $idProyek) {
            // Tiap proyek punya 3-8 anggota tim
            $jumlahAnggota = $faker->numberBetween(3, 8);

            // Pilih pekerja random untuk proyek ini
            $pekerjaDipilih = $faker->randomElements($pekerjaIds, $jumlahAnggota);

            foreach ($pekerjaDipilih as $index => $idPekerja) {
                // Orang pertama selalu supervisor, kedua pengawas, sisanya pekerja
                $peran = 'pekerja';
                if ($index == 0) $peran = 'supervisor';
                else if ($index == 1) $peran = 'pengawas';

                $timProjectId = DB::table('tim_project')->insertGetId([
                    'id_project_disetujui' => $idProyek,
                    'peran' => $peran,
                    'id_pekerja' => $idPekerja,
                    'keahlian' => $faker->randomElement($keahlian),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $timProjectIds[] = $timProjectId;
            }
        }

        // =========== 9. Penjadwalan ===========
        $penjadwalanIds = [];
        $pekerjaanJadwal = [
            'Pembersihan Lokasi', 'Peletakan Pondasi', 'Pemasangan Rangka', 'Pengecoran',
            'Pemasangan Dinding', 'Instalasi Listrik', 'Pemasangan Plafon', 'Pemasangan Lantai',
            'Pengecatan', 'Instalasi Sanitasi', 'Finishing Interior', 'Pembuatan Taman',
            'Pemasangan Pintu dan Jendela', 'Testing & Commissioning', 'Pembersihan Akhir'
        ];
        $statusJadwal = ['tersedia', 'sedang dikerjakan', 'batal', 'selesai'];

        // Untuk setiap proyek disetujui, buat penjadwalan
        foreach ($proyekDisetujuiIds as $idProyek) {
            $proyekInfo = DB::table('proyek_disetujui')->where('id', $idProyek)->first();
            if (!$proyekInfo) continue;

            // Tiap proyek punya 5-10 jadwal pekerjaan
            $jumlahJadwal = $faker->numberBetween(5, 10);

            // Ambil tanggal mulai proyek sebagai patokan
            $tanggalMulaiProyek = Carbon::parse($proyekInfo->tanggal_mulai);

            // Bagi durasi proyek menjadi beberapa fase
            for ($i = 0; $i < $jumlahJadwal; $i++) {
                $tanggalMulaiJadwal = $tanggalMulaiProyek->copy()->addDays($i * 10);
                $tanggalSelesaiJadwal = $tanggalMulaiJadwal->copy()->addDays($faker->numberBetween(5, 15));

                // Tentukan status jadwal
                $status = 'tersedia';
                $now = Carbon::now();
                if ($tanggalSelesaiJadwal < $now) {
                    $status = 'selesai';
                } else if ($tanggalMulaiJadwal < $now && $tanggalSelesaiJadwal > $now) {
                    $status = 'sedang dikerjakan';
                } else if ($faker->boolean(10)) { // 10% kemungkinan batal
                    $status = 'batal';
                }

                // Pilih tim proyek untuk jadwal ini
                $timProyekIni = DB::table('tim_project')
                    ->where('id_project_disetujui', $idProyek)
                    ->inRandomOrder()
                    ->first();

                $penjadwalanId = DB::table('penjadwalan')->insertGetId([
                    'tanggal_mulai' => $tanggalMulaiJadwal,
                    'tanggal_selesai' => $tanggalSelesaiJadwal,
                    'pekerjaan' => $faker->randomElement($pekerjaanJadwal),
                    'id_proyek_disetujui' => $idProyek,
                    'status' => $status,
                    'id_tim_project' => $timProyekIni ? $timProyekIni->id : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $penjadwalanIds[] = $penjadwalanId;
            }
        }

        // =========== 10. Monitoring Proyek ===========
        // Dari migrasi, tabel monitoring_proyek hanya memiliki timestamps
        // Pastikan ada kolom id_proyek_disetujui dan id_penjadwalan

        // Tambahkan kolom-kolom yang dibutuhkan jika belum ada
        if (!Schema::hasColumn('monitoring_proyek', 'id_proyek_disetujui')) {
            // Skip seeding monitoring proyek atau gunakan kolom minimal
            foreach ($penjadwalanIds as $idPenjadwalan) {
                $penjadwalanInfo = DB::table('penjadwalan')->where('id', $idPenjadwalan)->first();
                if (!$penjadwalanInfo) continue;

                // Hanya tambahkan data timestamp saja
                DB::table('monitoring_proyek')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Jika kolom ada, gunakan secara normal
            $statusMonitoring = ['Sudah Direview', 'Belum Direview'];

            foreach ($penjadwalanIds as $idPenjadwalan) {
                $penjadwalanInfo = DB::table('penjadwalan')->where('id', $idPenjadwalan)->first();
                if (!$penjadwalanInfo) continue;

                // Tentukan status monitoring berdasarkan status jadwal
                $status = 'Belum Direview';
                if ($penjadwalanInfo->status == 'selesai') {
                    $status = 'Sudah Direview';
                }

                DB::table('monitoring_proyek')->insert([
                    'id_proyek_disetujui' => $penjadwalanInfo->id_proyek_disetujui,
                    'id_penjadwalan' => $idPenjadwalan,
                    'status' => $status,
                    'keterangan' => $status == 'Sudah Direview' ? substr($faker->sentence(), 0, 255) : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // =========== 11. Dokumen Penyelesaian Proyek ===========
        $proyekSelesai = DB::table('proyek_disetujui')->where('status', 'Selesai')->get();

        foreach ($proyekSelesai as $proyek) {
            DB::table('dokumen_penyelesaian_proyek')->insert([
                'id_proyek_disetujui' => $proyek->id,
                'file' => 'dokumen_selesai_' . $proyek->id . '.pdf',
                'keterangan' => substr($faker->paragraph(), 0, 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========== 12. Pelaksanaan Proyek ===========
        $timProyek = DB::table('tim_project')->get();

        foreach ($timProyek as $tim) {
            // Generate 1-3 laporan pelaksanaan untuk tiap tim proyek
            $jumlahLaporan = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $jumlahLaporan; $i++) {
                DB::table('pelaksanaan_proyek')->insert([
                    'id_tim_proyek' => $tim->id,
                    'foto' => 'pelaksanaan_' . $tim->id . '_' . ($i+1) . '.jpg',
                    'deskripsi_pengerjaan' => substr($faker->paragraph(), 0, 255),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // =========== 13. Evaluasi Proyek ===========
        foreach ($proyekDisetujuiIds as $idProyek) {
            $proyekInfo = DB::table('proyek_disetujui')->where('id', $idProyek)->first();
            if (!$proyekInfo || $proyekInfo->status !== 'Selesai') continue;

            DB::table('evaluasi_proyek')->insert([
                'id_proyek_disetujui' => $idProyek,
                'keterangan' => substr($faker->paragraph(1), 0, 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========== 14. Produk ===========
        $produkIds = [];
        $namaProduk = [
            'Semen Mortar 40kg', 'Bata Ringan 10x20x60', 'Cat Tembok 5kg', 'Pipa PVC 4 inch',
            'Kabel Listrik NYM 2x1.5mm', 'Besi Beton 8mm', 'Keramik Lantai 60x60', 'Kunci Pintu',
            'Saklar Listrik', 'Bola Lampu LED 10W', 'Kaca Jendela 5mm', 'Triplek 8mm',
            'Genteng Beton', 'Kloset Duduk', 'Wastafel', 'Paku 5cm', 'Engsel Pintu',
            'Lem Kayu', 'Sekrup Gypsum', 'Benang Rol', 'Water Proof', 'Kawat Las'
        ];
        $satuan = ['pcs', 'kg', 'ton', 'liter', 'box', 'meter', 'roll', 'sak', 'batang', 'lembar'];

        foreach ($namaProduk as $index => $nama) {
            $produkId = DB::table('produk')->insertGetId([
                'nama' => $nama,
                'harga' => $faker->randomFloat(2, 10000, 999999.99),
                'foto' => 'produk_' . ($index+1) . '.jpg',
                'satuan' => $faker->randomElement($satuan),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $produkIds[] = $produkId;
        }

        // =========== 15. Marketing ===========
        // Koneksi produk dengan customer
        for ($i = 0; $i < 15; $i++) {
            DB::table('marketing')->insert([
                'produk_id' => $faker->randomElement($produkIds),
                'customer_id' => $faker->randomElement($customerIds),
                'tanggal_pembelian' => $faker->dateTimeBetween('-1 year', 'now'),
                'tujuan_pembelian' => $faker->sentence(),
                'jenis_pembayaran' => $faker->randomElement(['Tunai', 'Kredit', 'Transfer Bank']),
                'keterangan_pembayaran' => $faker->randomElement([null, $faker->sentence()]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========== 16. Pembelian ===========
        $pembelianIds = [];

        foreach ($proyekDisetujuiIds as $idProyek) {
            // Setiap proyek punya 2-5 pembelian
            $jumlahPembelian = $faker->numberBetween(2, 5);

            for ($i = 0; $i < $jumlahPembelian; $i++) {
                $pembelianId = DB::table('pembelian')->insertGetId([
                    'id_proyek_disetujui' => $idProyek,
                    'tanggal' => $faker->dateTimeBetween('-1 year', 'now'),
                    'no_nota' => 'INV-' . $faker->unique()->numerify('#####'),
                    'foto_nota' => 'nota_' . $idProyek . '_' . ($i+1) . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $pembelianIds[] = $pembelianId;
            }
        }

        // =========== 17. Detail Pembelian ===========
        foreach ($pembelianIds as $idPembelian) {
            // Setiap pembelian punya 3-8 item
            $jumlahItem = $faker->numberBetween(3, 8);

            // Pilih produk random untuk pembelian ini
            $produkDipilih = $faker->randomElements($produkIds, $jumlahItem);

            foreach ($produkDipilih as $idProduk) {
                $produkInfo = DB::table('produk')->where('id', $idProduk)->first();
                if (!$produkInfo) continue;

                $qty = $faker->numberBetween(1, 20);
                $hargaSatuan = $produkInfo->harga;
                $totalHarga = $qty * $hargaSatuan;

                DB::table('detail_pembelian')->insert([
                    'nama_produk' => $produkInfo->nama,
                    'satuan' => $faker->randomElement(['pcs', 'kg', 'ton', 'liter', 'box']),
                    'qty' => $qty,
                    'id_pembelian' => $idPembelian,
                    'harga_satuan' => $hargaSatuan,
                    'total_harga' => $totalHarga,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // =========== 18. Sewa Alat ===========
        $namaAlat = [
            'Excavator', 'Bulldozer', 'Crane', 'Concrete Mixer', 'Forklift',
            'Generator Set', 'Scaffolding', 'Jack Hammer', 'Cement Mixer', 'Water Pump',
            'Compressor', 'Mesin Las', 'Stamper', 'Chainsaw', 'Mesin Bor'
        ];

        for ($i = 0; $i < 10; $i++) {
            DB::table('sewa_alat')->insert([
                'nama_alat' => $faker->randomElement($namaAlat),
                'harga_sewa' => $faker->numberBetween(500000, 5000000),
                'customer_id' => $faker->randomElement($tempatProyekIds), // menggunakan tempat_proyek id sesuai schema
                'qty' => $faker->numberBetween(1, 5),
                'detail' => substr($faker->sentence(), 0, 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========== 19. Aktor ===========
        $roles = ['admin', 'staff', 'supervisor', 'pelaksana', 'keuangan', 'marketing'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('aktor')->insert([
                'username' => $faker->unique()->userName(),
                'password' => Hash::make('password123'),
                'email' => $faker->unique()->safeEmail(),
                'role' => $faker->randomElement($roles),
            ]);
        }

        // =========== 20. Penjualan ===========
        $penjualanIds = [];
        $jenisPembayaran = ['Tunai', 'Down Payment', 'Pelunasan'];

        for ($i = 0; $i < 10; $i++) {
            $penjualanId = DB::table('penjualan')->insertGetId([
                'tanggal_penjualan' => $faker->dateTimeBetween('-1 year', 'now'),
                'jenis_pembayaran' => $faker->randomElement($jenisPembayaran),
                'total_harga' => $faker->numberBetween(100000, 50000000),
                'id_customer' => $faker->randomElement($customerIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $penjualanIds[] = $penjualanId;
        }

        // =========== 21. Detail Penjualan ===========
        foreach ($penjualanIds as $idPenjualan) {
            // Setiap penjualan punya 1-5 item produk
            $jumlahItem = $faker->numberBetween(1, 5);
            $produkDipilih = $faker->randomElements($produkIds, $jumlahItem);

            foreach ($produkDipilih as $idProduk) {
                $qty = $faker->numberBetween(1, 10);
                $hargaSatuan = $faker->numberBetween(50000, 5000000);
                $totalHarga = $qty * $hargaSatuan;

                DB::table('detail_penjualan')->insert([
                    'id_penjualan' => $idPenjualan,
                    'id_produk' => $idProduk,
                    'qty' => $qty,
                    'unit' => $faker->numberBetween(1, 10),
                    'harga_satuan' => $hargaSatuan,
                    'total_harga' => $totalHarga,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
