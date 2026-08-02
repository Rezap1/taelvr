<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');
        
        if ($request->has('module') && $request->module != '') {
            $query->where('module', $request->module);
        }
        
        if ($request->has('action') && $request->action != '') {
            $query->where('action', $request->action);
        }
        
        $items = $query->latest()->paginate(20)->withQueryString();
        $modules = ActivityLog::select('module')->distinct()->whereNotNull('module')->pluck('module');
        
        return view('admin.activity-logs.index', compact('items', 'modules'));
    }
}
