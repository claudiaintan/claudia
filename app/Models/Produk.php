<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function barangTransaksi(): HasMany
    {
        return $this->hasMany(BarangTransaksi::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
