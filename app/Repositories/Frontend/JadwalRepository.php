<?php

namespace App\Repositories\Frontend;

use App\Models\JadwalPmb;
use Illuminate\Support\Facades\Cache;

class JadwalRepository
{
    public function getActiveJadwal()
    {
        return Cache::remember('frontend_jadwal_pmb', 3600, function () {
            return JadwalPmb::active()->orderBy('tanggal_mulai')->get();
        });
    }
}
