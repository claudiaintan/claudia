<?php

namespace Database\Factories;

use App\Enums\StatusKirim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(StatusKirim::toArray()),
            'kodepos' => fake()->postcode(),
            'alamat' => fake()->streetAddress(),
        ];
    }
}
