<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(), // Nama kota menggunakan faker
            'state_id' => function () {
                // Ambil ID state secara acak dari tabel states
                return DB::table('states')->inRandomOrder()->value('id');
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
