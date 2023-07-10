<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 100),
            'customer' => ucwords(fake()->sentence()),
            'berat' => fake()->randomFloat(2, 0, 100),
            'total_harga' => fake()->randomFloat(2, 0,100),
            'tgl_masuk' => fake()->date(),
            'tgl_keluar' => fake()->date(),
            'is_complete' => rand(0, 1)
        ];
    }
}
