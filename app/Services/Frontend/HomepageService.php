<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\HomepageRepository;

class HomepageService
{
    protected $repository;

    public function __construct(HomepageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHomepageData()
    {
        return [
            'banners' => $this->repository->getActiveBanners(),
            'program_studi' => $this->repository->getFeaturedProgramStudi(3),
            'fasilitas' => $this->repository->getFeaturedFasilitas(4),
            'prestasi' => $this->repository->getLatestPrestasi(3),
            'galeri' => $this->repository->getLatestGaleri(6),
        ];
    }
}
