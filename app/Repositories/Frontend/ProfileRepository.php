<?php

namespace App\Repositories\Frontend;

use App\Models\ProfilFakultas;
use Illuminate\Support\Facades\Cache;

class ProfileRepository
{
    public function getProfil()
    {
        return Cache::remember('frontend_profil', 3600, function () {
            return ProfilFakultas::first();
        });
    }
}
