<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\HomepageService;

class HomeController extends Controller
{
    protected $homepageService;

    public function __construct(HomepageService $homepageService)
    {
        $this->homepageService = $homepageService;
    }

    /**
     * Tampilkan halaman beranda.
     */
    public function index()
    {
        try {
            $data = $this->homepageService->getHomepageData();
            return view('frontend.home', $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('HomeController index error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return view('errors.503'); // Graceful fallback
        }
    }
}
