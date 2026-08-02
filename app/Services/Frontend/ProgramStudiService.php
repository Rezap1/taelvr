<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\ProgramStudiRepository;

class ProgramStudiService
{
    protected $repository;

    public function __construct(ProgramStudiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllActive()
    {
        return $this->repository->getActiveProgramStudi();
    }

    public function getDetail(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }
}
