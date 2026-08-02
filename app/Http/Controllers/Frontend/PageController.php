<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\BiayaService;
use App\Services\Frontend\FasilitasService;
use App\Services\Frontend\GaleriService;
use App\Services\Frontend\JadwalService;
use App\Services\Frontend\PmbService;
use App\Services\Frontend\PrestasiService;
use App\Services\Frontend\ProfileService;
use App\Services\Frontend\ProgramStudiService;
use App\Services\Frontend\SearchService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $profileService;
    protected $programStudiService;
    protected $fasilitasService;
    protected $prestasiService;
    protected $galeriService;
    protected $pmbService;
    protected $jadwalService;
    protected $biayaService;
    protected $searchService;

    public function __construct(
        ProfileService $profileService,
        ProgramStudiService $programStudiService,
        FasilitasService $fasilitasService,
        PrestasiService $prestasiService,
        GaleriService $galeriService,
        PmbService $pmbService,
        JadwalService $jadwalService,
        BiayaService $biayaService,
        SearchService $searchService
    ) {
        $this->profileService = $profileService;
        $this->programStudiService = $programStudiService;
        $this->fasilitasService = $fasilitasService;
        $this->prestasiService = $prestasiService;
        $this->galeriService = $galeriService;
        $this->pmbService = $pmbService;
        $this->jadwalService = $jadwalService;
        $this->biayaService = $biayaService;
        $this->searchService = $searchService;
    }

    public function profil()
    {
        try {
            $profil = $this->profileService->getProfileData();
            return view('frontend.profil', compact('profil'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController profil error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function programStudi()
    {
        try {
            $programStudi = $this->programStudiService->getAllActive();
            return view('frontend.program-studi.index', compact('programStudi'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController programStudi error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function programStudiShow($slug)
    {
        try {
            $prodi = $this->programStudiService->getDetail($slug);
            return view('frontend.program-studi.show', compact('prodi'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController programStudiShow error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function fasilitas()
    {
        try {
            $fasilitas = $this->fasilitasService->getPaginated(9);
            return view('frontend.fasilitas', compact('fasilitas'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController fasilitas error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function prestasi()
    {
        try {
            $prestasi = $this->prestasiService->getPaginated(10);
            return view('frontend.prestasi', compact('prestasi'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController prestasi error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function galeri(Request $request)
    {
        try {
            $kategoriId = $request->input('kategori');
            $galeri = $this->galeriService->getPaginated(9, $kategoriId);
            $kategoriGaleri = $this->galeriService->getKategori();
            return view('frontend.galeri', compact('galeri', 'kategoriGaleri'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController galeri error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function pmb()
    {
        try {
            $informasi = $this->pmbService->getInformasi();
            return view('frontend.pmb.informasi', compact('informasi'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController pmb error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function jadwalPmb()
    {
        try {
            $jadwal = $this->jadwalService->getJadwal();
            return view('frontend.pmb.jadwal', compact('jadwal'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController jadwalPmb error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function biaya()
    {
        try {
            $biayaGrouped = $this->biayaService->getBiayaGroupedByProdi();
            return view('frontend.biaya', compact('biayaGrouped'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController biaya error: ' . $e->getMessage());
            return view('errors.503');
        }
    }

    public function kontak()
    {
        // Kontak uses global settings from view composer
        return view('frontend.kontak');
    }

    public function search(Request $request)
    {
        try {
            $keyword = $request->input('q', '');
            $page = $request->input('page', 1);
            
            $results = $this->searchService->search($keyword, 10, $page);
            
            return view('frontend.search', compact('keyword', 'results'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PageController search error: ' . $e->getMessage());
            return view('errors.503');
        }
    }
}
