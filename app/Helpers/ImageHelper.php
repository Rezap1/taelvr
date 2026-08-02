<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('image_url')) {
    /**
     * Helper untuk menampilkan image URL dari storage atau default asset.
     *
     * @param string|null $path Lokasi file di storage.
     * @param string $default Lokasi default asset (misal: 'assets/img/default-thumbnail.jpg').
     * @param string $disk Disk storage yang digunakan (default: 'public').
     * @return string
     */
    function image_url(?string $path, string $default = 'assets/images/kampus_ft_unsur.png', string $disk = 'public'): string
    {
        if (empty($path)) {
            return asset($default);
        }

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }

        return asset($default);
    }
}
