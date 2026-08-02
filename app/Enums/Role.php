<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case ADMIN = 'ADMIN';

    /**
     * Label untuk ditampilkan di UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
        };
    }

    /**
     * Warna badge untuk UI.
     */
    public function badgeColor(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'danger',
            self::ADMIN => 'primary',
        };
    }
}
