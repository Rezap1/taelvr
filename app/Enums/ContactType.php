<?php

namespace App\Enums;

enum ContactType: string
{
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case ADDRESS = 'ADDRESS';
    case WHATSAPP = 'WHATSAPP';
    case INSTAGRAM = 'INSTAGRAM';
    case FACEBOOK = 'FACEBOOK';
    case YOUTUBE = 'YOUTUBE';
    case TIKTOK = 'TIKTOK';
    case LINKEDIN = 'LINKEDIN';
    case MAP = 'MAP';

    /**
     * Label untuk ditampilkan di UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::PHONE => 'Telepon',
            self::ADDRESS => 'Alamat',
            self::WHATSAPP => 'WhatsApp',
            self::INSTAGRAM => 'Instagram',
            self::FACEBOOK => 'Facebook',
            self::YOUTUBE => 'YouTube',
            self::TIKTOK => 'TikTok',
            self::LINKEDIN => 'LinkedIn',
            self::MAP => 'Google Maps',
        };
    }

    /**
     * Icon Font Awesome.
     */
    public function icon(): string
    {
        return match ($this) {
            self::EMAIL => 'fas fa-envelope',
            self::PHONE => 'fas fa-phone-alt',
            self::ADDRESS => 'fas fa-map-marker-alt',
            self::WHATSAPP => 'fab fa-whatsapp',
            self::INSTAGRAM => 'fab fa-instagram',
            self::FACEBOOK => 'fab fa-facebook-f',
            self::YOUTUBE => 'fab fa-youtube',
            self::TIKTOK => 'fab fa-tiktok',
            self::LINKEDIN => 'fab fa-linkedin-in',
            self::MAP => 'fas fa-map',
        };
    }
}
