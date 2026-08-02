<?php

namespace App\Repositories\Frontend;

use App\Models\Biaya;
use Illuminate\Support\Facades\Cache;

class BiayaRepository
{
    public function getActiveBiaya()
    {
        return Cache::remember('frontend_biaya', 3600, function () {
            // Eager load programStudi to avoid N+1 query
            return Biaya::with('programStudi')
                ->active()
                ->get();
        });
    }
}
