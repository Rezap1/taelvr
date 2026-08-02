<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\User;
use App\Models\LoginLog;
use App\Models\ActivityLog;
use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'program_studi' => ProgramStudi::count(),
            'fasilitas' => Fasilitas::count(),
            'prestasi' => Prestasi::count(),
            'galeri' => Galeri::count(),
            'admin' => User::count(),
            'media' => Media::count(),
        ];
        
        $loginLogs = LoginLog::with('user')->latest('login_at')->take(5)->get();
        $recentActivities = ActivityLog::with('user')->latest()->take(10)->get();
        
        // Calculate storage usage (basic estimation)
        $mediaStorage = Media::sum('file_size') ?? 0;
        
        // Example Chart data (Activity per day for last 7 days)
        $chartData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = \Carbon\Carbon::now()->subDays($i)->format('d M');
            $chartData[] = ActivityLog::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact('stats', 'loginLogs', 'recentActivities', 'mediaStorage', 'chartLabels', 'chartData'));
    }
}
