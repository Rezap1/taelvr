<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Services\MediaService;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('subtitle', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->latest()->paginate(10)->withQueryString();
        return view('admin.banners.index', compact('items'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('file')) {
            $media = $this->mediaService->upload($request->file('file'), 'banners', $request->title ?? 'Banner');
            $validated['file_path'] = $media->file_path;
        }

        $banner = Banner::create($validated);
        
        ActivityLogger::log('created', 'Banner', 'Membuat banner: ' . ($banner->title ?? 'Tanpa Judul'));

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', ['item' => $banner]);
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', ['item' => $banner]);
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('file')) {
            $media = $this->mediaService->upload($request->file('file'), 'banners', $request->title ?? 'Banner');
            $validated['file_path'] = $media->file_path;
        }

        $banner->update($validated);
        
        ActivityLogger::log('updated', 'Banner', 'Memperbarui banner: ' . ($banner->title ?? 'Tanpa Judul'));

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $title = $banner->title ?? 'Tanpa Judul';
        $banner->delete(); // Hard delete or we can use soft delete if added
        
        ActivityLogger::log('deleted', 'Banner', 'Menghapus banner: ' . $title);
        
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
