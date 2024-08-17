<?php

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Produk::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Transaksi::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('file', 255);
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_transaksis');
    }
};
