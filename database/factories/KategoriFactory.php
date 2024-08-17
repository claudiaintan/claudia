<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaKategori = [
            'Stiker dan label',
            'Spanduk dan banner',
            'Print kertas - Print on paper',
            'Merchandise dan souvenir',
        ];

        // Mengambil index berdasarkan count yang dihasilkan factory
        $index = $this->faker->unique()->numberBetween(0, count($namaKategori) - 1);

        return [
            'nama' => $namaKategori[$index],
        ];
    }
}