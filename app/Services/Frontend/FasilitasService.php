<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\FasilitasRepository;

class FasilitasService
{
    protected $repository;

    public function __construct(FasilitasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginated($perPage = 9)
    {
        return $this->repository->getPaginatedFasilitas($perPage);
    }
}
