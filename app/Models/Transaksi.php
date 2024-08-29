<?php

namespace App\Models;

use App\Enums\StatusKirim;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusKirim::class,
        ];
    }

    public function buktiPembayaran(): HasOne
    {
        return $this->hasOne(BuktiPembayaran::class);
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function ongkir()
    {
        return $this->belongsTo(Ongkir::class, 'ongkir_id'); 
    }

    public function barangTransaksi(): HasMany
    {
        return $this->hasMany(BarangTransaksi::class);
    }

    public function bobot(): int
    {
        return $this->barangTransaksi->reduce(function ($total, $item) {
            return $item->jumlah * $item->produk->bobot + $total;
        }, 0);
    }

    public function harga(): int
    {

        return $this->barangTransaksi->reduce(function ($total, $item) {
            return $item->jumlah * $item->produk->harga + $total;
        }, 0);
    }
}
