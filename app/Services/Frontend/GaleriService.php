<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\GaleriRepository;

class GaleriService
{
    protected $repository;

    public function __construct(GaleriRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginated($perPage = 9, $kategoriId = null)
    {
        return $this->repository->getPaginatedGaleri($perPage, $kategoriId);
    }

    public function getKategori()
    {
        return \App\Models\KategoriGaleri::active()->ordered()->get();
    }
}
