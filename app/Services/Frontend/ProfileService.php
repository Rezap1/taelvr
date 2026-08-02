<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\ProfileRepository;

class ProfileService
{
    protected $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProfileData()
    {
        return $this->repository->getProfil();
    }
}
