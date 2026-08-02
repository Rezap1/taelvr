<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Halaman Statis
        $staticPages = [
            route('home'),
            route('profil'),
            route('program-studi'),
            route('fasilitas'),
            route('prestasi'),
            route('galeri'),
            route('pmb'),
            route('jadwal-pmb'),
            route('biaya'),
            route('kontak'),
        ];

        foreach ($staticPages as $url) {
            $urls[] = [
                'loc' => $url,
                'lastmod' => now()->startOfDay()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // Program Studi Dinamis
        $prodis = ProgramStudi::active()->get();
        foreach ($prodis as $prodi) {
            $urls[] = [
                'loc' => route('program-studi.show', $prodi->slug),
                'lastmod' => $prodi->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.9',
            ];
        }

        return response()->view('frontend.sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
