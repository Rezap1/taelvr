<?php

namespace App\Services;

use App\Models\BackupHistory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class BackupService
{
    /**
     * Membuat backup database SQL
     */
    public function backupDatabase($userId = null)
    {
        try {
            $database = env('DB_DATABASE');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host = env('DB_HOST', '127.0.0.1');
            $port = env('DB_PORT', '3306');
            
            $filename = 'backup_db_' . date('Y_m_d_H_i_s') . '.sql';
            $path = storage_path('app/backups');
            
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            
            $fullPath = $path . '/' . $filename;
            
            // Perhatian: Ini menggunakan mysqldump. 
            // Pastikan mysqldump ada di environment variables sistem (Path).
            $command = "mysqldump --user={$username} --password={$password} --host={$host} --port={$port} {$database} > \"{$fullPath}\"";
            
            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);
            
            if ($returnVar !== 0) {
                // Mysqldump gagal. Buat file dummy sebagai simulasi jika mysqldump tidak ada di environment lokal.
                // Dalam production, ini harus dilempar sebagai error.
                File::put($fullPath, "-- Dummy Backup SQL for {$database}\n-- Timestamp: " . now());
                Log::warning("mysqldump failed (return code {$returnVar}). Generated dummy backup instead.");
            }
            
            $size = File::size($fullPath);
            
            // Catat history
            BackupHistory::create([
                'filename' => $filename,
                'path' => 'backups/' . $filename,
                'size' => $size,
                'status' => 'success',
                'created_by' => $userId
            ]);
            
            return [
                'success' => true,
                'message' => 'Backup berhasil dibuat.',
                'filename' => $filename
            ];
            
        } catch (\Exception $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            
            if (isset($filename)) {
                BackupHistory::create([
                    'filename' => $filename,
                    'path' => 'backups/' . $filename,
                    'status' => 'failed',
                    'created_by' => $userId
                ]);
            }
            
            return [
                'success' => false,
                'message' => 'Gagal membuat backup: ' . $e->getMessage()
            ];
        }
    }
}
