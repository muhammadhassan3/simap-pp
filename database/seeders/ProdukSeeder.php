<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Pig Iron',
                'harga' => 750000,
                'foto' => 'pig_iron.jpg',
                'deskripsi' => 'Besi mentah',
                'satuan' => 'Ton',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Semen Portland',
                'harga' => 60000,
                'foto' => 'semen_portland.jpg',
                'deskripsi' => 'Jenis semen',
                'satuan' => 'Sak (50 kg)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pasir Beton',
                'harga' => 180000,
                'foto' => 'pasir_beton.jpg',
                'deskripsi' => 'Pasir kasar',
                'satuan' => 'Kubik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Baja WF 200',
                'harga' => 2500000,
                'foto' => 'baja_wf_200.jpg',
                'deskripsi' => 'Baja wide flange',
                'satuan' => 'Batang (6m)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Batu Split 1/2',
                'harga' => 300000,
                'foto' => 'batu_split.jpg',
                'deskripsi' => 'Batu pecah',
                'satuan' => 'Kubik',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
