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
                'address' => 'Jl. Merdeka No. 1',
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Jane Smith',
                'nik' => '1234567890123457',
                'patient_number' => 'P002',
                'gender' => 'Perempuan',
                'birth_date' => '1995-05-15',
                'address' => 'Jl. Sudirman No. 2',
                'phone' => '081987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Michael Johnson',
                'nik' => '1234567890123458',
                'patient_number' => 'P003',
                'gender' => 'Laki-laki',
                'birth_date' => '1985-03-10',
                'address' => 'Jl. Thamrin No. 3',
                'phone' => '081345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Emily Davis',
                'nik' => '1234567890123459',
                'patient_number' => 'P004',
                'gender' => 'Perempuan',
                'birth_date' => '2000-07-20',
                'address' => 'Jl. Gatot Subroto No. 4',
                'phone' => '081456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'William Brown',
                'nik' => '1234567890123460',
                'patient_number' => 'P005',
                'gender' => 'Laki-laki',
                'birth_date' => '1992-11-25',
                'address' => 'Jl. Ahmad Yani No. 5',
                'phone' => '081567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
