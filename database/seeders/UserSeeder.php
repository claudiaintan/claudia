<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role' => Role::ADMIN,
        ]);

        $userPelanggan = User::factory()->create([
            'name' => 'pelanggan',
            'email' => 'pelanggan@example.com',
            'password' => 'pelanggan',
            'role' => Role::PELANGGAN,
        ]);

        Pelanggan::factory()->for($userPelanggan)->create();
    }
}
