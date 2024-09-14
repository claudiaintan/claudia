<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StatusPembayaran: string
{
    use EnumToArray;

    case LUNAS = "LUNAS";
    case BELUM_LUNAS = "BELUM_LUNAS";

    public function display(): string
    {
        return match ($this) {
            StatusPembayaran::LUNAS => "Lunas",
            StatusPembayaran::BELUM_LUNAS => "Menunggu Konfirmasi",
        };
    }
}
