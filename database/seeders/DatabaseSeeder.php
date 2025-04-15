<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat pengguna dengan berbagai role
        $password = Hash::make('12345678');
        User::create([
            'name' => 'Admin User',
            'username' => 'admin01',
            'password' =>  $password,
            'role' => 'admin', // Role admin
        ]);

        User::create([
            'name' => 'Doctor User',
            'username' => 'doctor01',
            'password' =>  $password,
            'role' => 'doctor', // Role doctor
        ]);

        User::create([
            'name' => 'Kasir User',
            'username' => 'kasir01',
            'password' =>  $password,
            'role' => 'kasir', // Role kasir
        ]);

        User::create([
            'name' => 'Staff User',
            'username' => 'staff01',
            'password' =>  $password,
            'role' => 'staff', // Role staff
        ]);

        // Panggil seeder lainnya
        $this->call(DrugSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
    }
}
