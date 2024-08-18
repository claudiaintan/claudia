<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\BarangTransaksi;
use App\Models\BuktiPembayaran;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Ongkir;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPelanggan = User::factory()->create([
            'name' => 'pelanggan1',
            'email' => 'pelanggan1@example.com',
            'password' => 'pelanggan1',
            'role' => Role::PELANGGAN,
        ]);

        $pelanggan = Pelanggan::factory()->for($userPelanggan)->create();

        $ongkir = Ongkir::factory()->create([
            'nama' => 'Cepat',
            'harga' => 25000,
        ]);
        $kategoris = Kategori::factory(4)->create();

        Produk::factory(5)->for($kategoris[2])->create();
        $produk = Produk::factory()->for($kategoris[0])->create();
        $produk1 = Produk::factory()->for($kategoris[1])->create();
        $produk2 = Produk::factory()->for($kategoris[3])->create();

        // Keranjang::factory()->for($produk)->for($pelanggan)->create();
        // Keranjang::factory()->for($produk1)->for($pelanggan)->create();
        // Keranjang::factory()->for($produk2)->for($pelanggan)->create();
        // $transaksi = Transaksi::factory()->for($pelanggan)->for($ongkir)->create();
        // BarangTransaksi::factory()->for($transaksi)->for($produk)->create();

        // $transaksiBayar = Transaksi::factory()->for($pelanggan)->for($ongkir)->create();
        // BarangTransaksi::factory()->for($transaksiBayar)->for($produk1)->create();
        // BuktiPembayaran::factory()->for($transaksiBayar)->create();

        // $transaksiBayar = Transaksi::factory()->for($pelanggan)->for($ongkir)->create();
        // BarangTransaksi::factory()->for($transaksiBayar)->for($produk1)->create();
        // BarangTransaksi::factory()->for($transaksiBayar)->for($produk2)->create();
        // BuktiPembayaran::factory()->for($transaksiBayar)->create();
    }
}
