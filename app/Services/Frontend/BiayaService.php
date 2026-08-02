<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\BiayaRepository;

class BiayaService
{
    protected $repository;

    public function __construct(BiayaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBiayaGroupedByProdi()
    {
        $biayaList = $this->repository->getActiveBiaya();
        
        // Group by program_studi_id or slug for frontend display
        return $biayaList->groupBy(function ($item) {
            return $item->programStudi ? $item->programStudi->nama : 'Umum';
        });
    }
}
