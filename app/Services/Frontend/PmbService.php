<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\PmbRepository;

class PmbService
{
    protected $repository;

    public function __construct(PmbRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getInformasi()
    {
        return $this->repository->getActiveInformasi();
    }
}
