<?php

namespace App\Repositories\Frontend;

use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\InformasiPmb;
use App\Models\Prestasi;
use App\Models\ProgramStudi;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchRepository
{
    public function globalSearch(string $keyword, int $perPage = 10, int $page = 1)
    {
        $results = new Collection();

        // 1. Search Program Studi
        $prodi = ProgramStudi::active()
            ->where(function($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })->get()->map(function($item) {
                return [
                    'type' => 'Program Studi',
                    'title' => $item->nama,
                    'description' => $item->deskripsi,
                    'url' => route('program-studi.show', $item->slug),
                    'badge' => 'bg-primary'
                ];
            });
        $results = $results->merge($prodi);

        // 2. Search Prestasi
        $prestasi = Prestasi::where('judul', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Prestasi',
                    'title' => $item->judul,
                    'description' => $item->deskripsi,
                    'url' => route('prestasi'),
                    'badge' => 'bg-warning text-dark'
                ];
            });
        $results = $results->merge($prestasi);

        // 3. Search Fasilitas
        $fasilitas = Fasilitas::where('nama', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Fasilitas',
                    'title' => $item->nama,
                    'description' => $item->deskripsi,
                    'url' => route('fasilitas'),
                    'badge' => 'bg-success'
                ];
            });
        $results = $results->merge($fasilitas);

        // 4. Search Galeri
        $galeri = Galeri::where('judul', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Galeri',
                    'title' => $item->judul,
                    'description' => $item->deskripsi,
                    'url' => route('galeri'),
                    'badge' => 'bg-info'
                ];
            });
        $results = $results->merge($galeri);

        // 5. Search Informasi PMB
        $pmb = InformasiPmb::active()
            ->where(function($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })->get()->map(function($item) {
                return [
                    'type' => 'Informasi PMB',
                    'title' => $item->judul,
                    'description' => strip_tags($item->deskripsi),
                    'url' => route('pmb'),
                    'badge' => 'bg-danger'
                ];
            });
        $results = $results->merge($pmb);

        // Paginate the collection
        $total = $results->count();
        $results = $results->forPage($page, $perPage)->values();

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }
}
