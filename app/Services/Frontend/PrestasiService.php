<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\PrestasiRepository;

class PrestasiService
{
    protected $repository;

    public function __construct(PrestasiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginated($perPage = 10)
    {
        return $this->repository->getPaginatedPrestasi($perPage);
    }
}
