<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = [
            [
                'nama' => 'Teknik Informatika',
                'kode' => 'TIF',
                'jenjang' => 'S1',
                'akreditasi' => 'B',
                'deskripsi' => 'Program Studi Teknik Informatika membekali mahasiswa dengan kemampuan pemrograman, rekayasa perangkat lunak, jaringan komputer, dan kecerdasan buatan.',
                'prospek_karir' => 'Software Engineer, Data Scientist, System Analyst, IT Consultant',
                'icon' => 'fas fa-laptop-code',
            ],
            [
                'nama' => 'Teknik Sipil',
                'kode' => 'TSP',
                'jenjang' => 'S1',
                'akreditasi' => 'B',
                'deskripsi' => 'Program Studi Teknik Sipil mempelajari tentang perencanaan, perancangan, konstruksi, dan manajemen infrastruktur seperti gedung, jalan, dan jembatan.',
                'prospek_karir' => 'Civil Engineer, Project Manager, Konsultan Struktur, Kontraktor',
                'icon' => 'fas fa-hard-hat',
            ],
            [
                'nama' => 'Teknik Industri',
                'kode' => 'TIN',
                'jenjang' => 'S1',
                'akreditasi' => 'B',
                'deskripsi' => 'Program Studi Teknik Industri fokus pada optimalisasi sistem yang kompleks, proses, organisasi, atau sistem yang mengintegrasikan manusia, material, informasi, dan energi.',
                'prospek_karir' => 'Industrial Engineer, Production Manager, Quality Control, Supply Chain Manager',
                'icon' => 'fas fa-cogs',
            ],
        ];

        foreach ($prodis as $index => $prodi) {
            ProgramStudi::firstOrCreate(
                ['slug' => Str::slug($prodi['nama'])],
                array_merge($prodi, [
                    'is_active' => true,
                    'urutan' => $index + 1,
                ])
            );
        }
    }
}
