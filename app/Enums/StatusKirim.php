<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum StatusKirim: string
{
    use EnumToArray;

    case SAMPAI = "SAMPAI";
    case PERJALANAN = "PERJALANAN";
    case PROSES = "PROSES";

    public function display(): string
    {
        return match ($this) {
            StatusKirim::SAMPAI => "Sampai",
            StatusKirim::PERJALANAN => "Perjalanan",
            StatusKirim::PROSES => "Proses",
        };
    }
}
