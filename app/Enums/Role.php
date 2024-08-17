<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Role: string
{
    use EnumToArray;

    case ADMIN = "ADMIN";
    case PELANGGAN = "PELANGGAN";

    public function display(): string
    {
        return match ($this) {
            Role::ADMIN => "Admin",
            Role::PELANGGAN => "Pelanggan",
        };
    }
}
