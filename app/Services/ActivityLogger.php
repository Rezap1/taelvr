<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Mencatat aktivitas admin ke dalam tabel activity_logs
     * 
     * @param string $action (e.g. 'created', 'updated', 'deleted')
     * @param string|null $module Nama modul (e.g. 'Galeri', 'Banner')
     * @param string|null $details Detail aktivitas atau ID terkait
     */
    public static function log($action, $module = null, $details = null)
    {
        try {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'module' => $module,
                'details' => $details,
                'url' => Request::fullUrl(),
                'method' => Request::method(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        } catch (\Exception $e) {
            // Silently fail if logging fails so it doesn't break the main request
            \Illuminate\Support\Facades\Log::error('Activity Log failed: ' . $e->getMessage());
        }
    }
}
