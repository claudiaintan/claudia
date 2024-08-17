<?php

use App\Enums\StatusPembayaran;
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
        Schema::create('bukti_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Transaksi::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('gambar', 255);
            $table->enum('status', StatusPembayaran::toArray())->default(StatusPembayaran::BELUM_LUNAS->name);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pembayarans');
    }
};
