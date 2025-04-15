<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // UUID untuk kolom id
            'country_id' => function () {
                // Cari ID negara Indonesia di tabel countries
                return DB::table('countries')->where('name', 'Indonesia')->value('id');
            },
            'name' => $this->faker->state(), // Nama provinsi menggunakan faker
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
