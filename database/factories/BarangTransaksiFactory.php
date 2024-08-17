<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangTransaksi>
 */
class BarangTransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = fake()->image('public/storage/file');
        $path = str_replace('public/', '', $path);

        return [
            'file' => $path,
            'jumlah' => fake()->randomNumber(1, 5),
        ];
    }
}
