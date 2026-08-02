<?php

namespace App\Repositories\Frontend;

use App\Models\InformasiPmb;
use Illuminate\Support\Facades\Cache;

class PmbRepository
{
    public function getActiveInformasi()
    {
        return Cache::remember('frontend_informasi_pmb', 3600, function () {
            return InformasiPmb::active()->ordered()->first();
        });
    }
}
