<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('file_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('file_type', $request->type);
        }

        $items = $query->latest()->paginate(16)->withQueryString();
        
        return view('admin.media.index', compact('items'));
    }

    public function store(MediaRequest $request)
    {
        if ($request->hasFile('file')) {
            $media = $this->mediaService->upload(
                $request->file('file'),
                'media', // Folder
                $request->title
            );
            
            if ($request->alt_text) {
                $media->update(['alt_text' => $request->alt_text]);
            }
        }

        return redirect()->route('admin.media.index')->with('success', 'File berhasil diunggah.');
    }

    public function update(MediaRequest $request, Media $medium)
    {
        $medium->update([
            'title' => $request->title,
            'alt_text' => $request->alt_text,
        ]);

        return redirect()->back()->with('success', 'Informasi media berhasil diperbarui.');
    }

    public function destroy(Media $medium)
    {
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = Media::onlyTrashed()->latest()->paginate(16);
        return view('admin.media.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Media::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Media berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Media::onlyTrashed()->findOrFail($id);
        $this->mediaService->deletePermanently($item);
        
        return redirect()->back()->with('success', 'Media dan file fisiknya berhasil dihapus permanen.');
    }
}
