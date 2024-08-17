<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        // Define the storage path
        $storagePath = storage_path('app/public/file');

        // Ensure the directory exists and is writable
        if (!Storage::disk('public')->exists('file')) {
            Storage::disk('public')->makeDirectory('file', 0777, true);
        }

        // Generate the image and get its path
        $imagePath = fake()->image($storagePath, 640, 480, null, false);

        // Store the path in the format that can be used to access it publicly
        $imagePath = 'file/' . basename($imagePath);

        return [
            'file' => $imagePath,
            'jumlah' => fake()->randomNumber(1, 5),
        ];
    }
}
