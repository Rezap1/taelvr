<?php

namespace Database\Seeders;

use App\Models\KategoriGaleri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriGaleriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Fasilitas Kampus',
            'Kegiatan Mahasiswa',
            'Kegiatan Akademik',
            'Prestasi',
            'Alumni',
        ];

        foreach ($kategoris as $index => $kategori) {
            KategoriGaleri::firstOrCreate(
                ['slug' => Str::slug($kategori)],
                [
                    'nama' => $kategori,
                    'deskripsi' => 'Galeri foto dan video untuk kategori ' . $kategori,
                    'urutan' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
