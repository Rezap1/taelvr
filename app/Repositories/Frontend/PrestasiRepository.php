<?php

namespace App\Repositories\Frontend;

use App\Models\Prestasi;

class PrestasiRepository
{
    public function getPaginatedPrestasi($perPage = 10)
    {
        return Prestasi::with('programStudi')->latest('tanggal')->paginate($perPage);
    }
}
