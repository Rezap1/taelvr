<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\JadwalRepository;

class JadwalService
{
    protected $repository;

    public function __construct(JadwalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getJadwal()
    {
        return $this->repository->getActiveJadwal();
    }
}
