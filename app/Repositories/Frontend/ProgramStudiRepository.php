<?php

namespace App\Repositories\Frontend;

use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Cache;

class ProgramStudiRepository
{
    public function getActiveProgramStudi()
    {
        return Cache::remember('frontend_program_studi', 3600, function () {
            return ProgramStudi::active()->ordered()->get();
        });
    }

    public function findBySlug(string $slug)
    {
        return ProgramStudi::active()->where('slug', $slug)->firstOrFail();
    }
}
