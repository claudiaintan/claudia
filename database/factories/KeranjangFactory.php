<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keranjang>
 */
class KeranjangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the storage path
        $storagePath = storage_path('app/public/produk');

        // Ensure the directory exists and is writable
        if (!Storage::disk('public')->exists('produk')) {
            Storage::disk('public')->makeDirectory('produk', 0777, true);
        }

        // Generate the image and get its path
        $imagePath = fake()->image($storagePath, 640, 480, null, false);

        // Store the path in the format that can be used to access it publicly
        $imagePath = 'produk/' . basename($imagePath);

        return [
            'file' => $imagePath,
            'jumlah' => fake()->randomNumber(1, 5),
        ];
    }
}
