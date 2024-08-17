<?php

namespace Database\Factories;

use App\Enums\StatusPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuktiPembayaran>
 */
class BuktiPembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = fake()->image('public/storage/bukti');
        $path = str_replace('public/', '', $path);

        return [
            'gambar' => $path,
            'status' => fake()->randomElement(StatusPembayaran::toArray()),
        ];
    }
}
