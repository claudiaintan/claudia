<?php

use App\Enums\StatusKirim;
use App\Models\Ongkir;
use App\Models\Pelanggan;
use App\Models\Produk;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pelanggan::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Ongkir::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('kodepos', 255);
            $table->string('alamat', 255);
            $table->enum('status', StatusKirim::toArray())->default(StatusKirim::PROSES->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
