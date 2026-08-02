<?php

namespace App\Observers;

use App\Models\ProfilFakultas;
use Illuminate\Support\Facades\Cache;

class ProfilFakultasObserver
{
    public function saved(ProfilFakultas $profil): void
    {
        Cache::forget('global_profil');
    }

    public function deleted(ProfilFakultas $profil): void
    {
        Cache::forget('global_profil');
    }
}
