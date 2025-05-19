<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan format Indonesia

        Customer::create([
            'no_identitas' => $faker->numerify('################'), // 16 digit angka
            'nama_customer' => 'PT. Pertamina',
            'alamat' => 'Jl. Medan Merdeka, Jakarta',
            'no_hp' => '08211234567',
            'email' => 'contact@pertamina.co.id',
        ]);

        Customer::create([
            'no_identitas' => $faker->numerify('################'),
            'nama_customer' => 'PT. Telkom Indonesia',
            'alamat' => 'Jl. Gatot Subroto, Jakarta',
            'no_hp' => '021-7654321',
            'email' => 'info@telkom.co.id',
        ]);

        Customer::create([
            'no_identitas' => $faker->numerify('################'),
            'nama_customer' => 'PT. Indofood',
            'alamat' => 'Jl. Sudirman, Jakarta',
            'no_hp' => '021-9988776',
            'email' => 'support@indofood.com',
        ]);

        Customer::create([
            'no_identitas' => $faker->numerify('################'),
            'nama_customer' => 'PT. Astra International',
            'alamat' => 'Jl. MH Thamrin, Jakarta',
            'no_hp' => '021-5566778',
            'email' => 'customer@astra.co.id',
        ]);
    }
}
