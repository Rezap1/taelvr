<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\SearchRepository;

class SearchService
{
    protected $repository;

    public function __construct(SearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(string $keyword, int $perPage = 10, int $page = 1)
    {
        if (empty(trim($keyword))) {
            return null;
        }

        return $this->repository->globalSearch($keyword, $perPage, $page);
    }
}
