<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = fake()->image('public/storage/produk');
        $path = str_replace('public/', '', $path);

        return [
            'nama' => fake()->word(),
            'harga' => fake()->numberBetween(1000, 100000),
            'gambar' => $path,
            'bobot' => fake()->numberBetween(1, 50),
        ];
    }
}
