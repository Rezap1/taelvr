<?php

namespace App\Repositories\Frontend;

use App\Models\Galeri;

class GaleriRepository
{
    public function getPaginatedGaleri($perPage = 9, $kategoriId = null)
    {
        $query = Galeri::with('kategoriGaleri')->latest();
        
        if ($kategoriId) {
            $query->where('kategori_galeri_id', $kategoriId);
        }

        return $query->paginate($perPage);
    }
}
