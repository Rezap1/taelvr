<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramStudi;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Galeri;

class SearchController extends Controller
{
    public function global(Request $request)
    {
        $keyword = $request->input('q');
        
        if (empty($keyword)) {
            return redirect()->back();
        }

        $results = collect();

        // Search in Program Studi
        $prodi = ProgramStudi::where('nama_prodi', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Program Studi',
                    'title' => $item->nama_prodi,
                    'url' => route('admin.program-studi.edit', $item->id),
                    'description' => strip_tags(substr($item->deskripsi, 0, 100)) . '...',
                    'icon' => 'fa-graduation-cap'
                ];
            });
        $results = $results->concat($prodi);

        // Search in Fasilitas
        $fasilitas = Fasilitas::where('nama_fasilitas', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Fasilitas',
                    'title' => $item->nama_fasilitas,
                    'url' => route('admin.fasilitas.edit', $item->id),
                    'description' => strip_tags(substr($item->deskripsi, 0, 100)) . '...',
                    'icon' => 'fa-building'
                ];
            });
        $results = $results->concat($fasilitas);

        // Search in Prestasi
        $prestasi = Prestasi::where('judul', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->get()->map(function($item) {
                return [
                    'type' => 'Prestasi',
                    'title' => $item->judul,
                    'url' => route('admin.prestasi.edit', $item->id),
                    'description' => strip_tags(substr($item->deskripsi, 0, 100)) . '...',
                    'icon' => 'fa-trophy'
                ];
            });
        $results = $results->concat($prestasi);

        return view('admin.search.results', compact('keyword', 'results'));
    }
}
