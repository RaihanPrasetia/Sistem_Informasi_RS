<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'John Doe',
                'nik' => '1234567890123456',
                'patient_number' => 'P001',
                'gender' => 'Laki-laki',
                'birth_date' => '1990-01-01',
                'age' => 30,
                'address' => 'Jl. Merdeka No. 1',
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
