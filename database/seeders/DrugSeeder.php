<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drugs')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Paracetamol',
                'type' => 'Tablet',
                'stock' => 100,
                'price' => 5000,
                'description' => 'Obat untuk meredakan demam dan nyeri ringan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Amoxicillin',
                'type' => 'Kapsul',
                'stock' => 50,
                'price' => 15000,
                'description' => 'Antibiotik untuk mengobati infeksi bakteri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ibuprofen',
                'type' => 'Sirup',
                'stock' => 30,
                'price' => 10000,
                'description' => 'Obat untuk mengurangi peradangan dan nyeri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Betadine',
                'type' => 'Salep',
                'stock' => 20,
                'price' => 20000,
                'description' => 'Antiseptik untuk luka luar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Vitamin C',
                'type' => 'Tablet',
                'stock' => 200,
                'price' => 3000,
                'description' => 'Suplemen untuk meningkatkan daya tahan tubuh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Dexamethasone',
                'type' => 'Tablet',
                'stock' => 80,
                'price' => 12000,
                'description' => 'Obat untuk mengurangi peradangan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Cetirizine',
                'type' => 'Tablet',
                'stock' => 60,
                'price' => 7000,
                'description' => 'Obat untuk mengatasi alergi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ranitidine',
                'type' => 'Tablet',
                'stock' => 40,
                'price' => 9000,
                'description' => 'Obat untuk mengatasi gangguan lambung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Chlorpheniramine',
                'type' => 'Sirup',
                'stock' => 25,
                'price' => 6000,
                'description' => 'Obat untuk mengatasi flu dan alergi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Hydrocortisone',
                'type' => 'Salep',
                'stock' => 15,
                'price' => 25000,
                'description' => 'Obat untuk mengatasi iritasi kulit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
