<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ongkir extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class);
    }
    
}
