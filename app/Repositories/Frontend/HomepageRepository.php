<?php

namespace App\Repositories\Frontend;

use App\Models\Banner;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Cache;

class HomepageRepository
{
    public function getActiveBanners()
    {
        return Cache::remember('home_banners', 3600, function () {
            return Banner::active()->ordered()->get();
        });
    }

    public function getFeaturedProgramStudi($limit = 3)
    {
        return Cache::remember('home_prodi_' . $limit, 3600, function () use ($limit) {
            return ProgramStudi::active()->ordered()->limit($limit)->get();
        });
    }

    public function getFeaturedFasilitas($limit = 4)
    {
        return Cache::remember('home_fasilitas_' . $limit, 3600, function () use ($limit) {
            return Fasilitas::latest()->limit($limit)->get();
        });
    }

    public function getLatestPrestasi($limit = 3)
    {
        return Cache::remember('home_prestasi_' . $limit, 3600, function () use ($limit) {
            return Prestasi::active()->latest('tanggal')->limit($limit)->get();
        });
    }

    public function getLatestGaleri($limit = 6)
    {
        return Cache::remember('home_galeri_' . $limit, 3600, function () use ($limit) {
            return Galeri::active()->latest()->limit($limit)->get();
        });
    }
}
