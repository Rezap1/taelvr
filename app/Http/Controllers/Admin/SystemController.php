<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use App\Services\ActivityLogger;
use App\Models\BackupHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

class SystemController extends Controller
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    public function index()
    {
        $backups = BackupHistory::with('creator')->latest()->paginate(10);
        return view('admin.system.index', compact('backups'));
    }

    public function clearCache()
    {
        Artisan::call('optimize:clear');
        
        ActivityLogger::log('updated', 'System', 'Melakukan clear cache sistem');

        return redirect()->back()->with('success', 'System cache berhasil dibersihkan.');
    }

    public function createBackup()
    {
        $result = $this->backupService->backupDatabase(auth()->id());
        
        if ($result['success']) {
            ActivityLogger::log('created', 'Backup', 'Membuat backup database: ' . $result['filename']);
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function downloadBackup($id)
    {
        $backup = BackupHistory::findOrFail($id);
        $fullPath = storage_path('app/' . $backup->path);
        
        if (file_exists($fullPath)) {
            ActivityLogger::log('downloaded', 'Backup', 'Mendownload file backup: ' . $backup->filename);
            return Response::download($fullPath);
        }
        
        return redirect()->back()->with('error', 'File backup tidak ditemukan di server.');
    }
    
    public function deleteBackup($id)
    {
        $backup = BackupHistory::findOrFail($id);
        $fullPath = storage_path('app/' . $backup->path);
        
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        
        $filename = $backup->filename;
        $backup->delete();
        
        ActivityLogger::log('deleted', 'Backup', 'Menghapus data backup: ' . $filename);
        
        return redirect()->back()->with('success', 'Data backup berhasil dihapus.');
    }
}
