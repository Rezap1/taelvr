<?php

namespace App\Repositories\Frontend;

use App\Models\Fasilitas;

class FasilitasRepository
{
    public function getPaginatedFasilitas($perPage = 9)
    {
        return Fasilitas::latest()->paginate($perPage);
    }
}
