<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleriRequest;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Services\MediaService;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $query = Galeri::with('kategoriGaleri');

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_galeri_id', $request->kategori);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->latest()->paginate(10)->withQueryString();
        $kategori = KategoriGaleri::where('is_active', true)->orderBy('urutan')->get();
        
        return view('admin.galeri.index', compact('items', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriGaleri::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.galeri.create', compact('kategori'));
    }

    public function store(GaleriRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('file')) {
            $media = $this->mediaService->upload($request->file('file'), 'galeri', $request->judul);
            $validated['file_path'] = $media->file_path;
            $validated['file_type'] = $media->file_type;
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Galeri $galeri)
    {
        $galeri->load('kategoriGaleri');
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        $kategori = KategoriGaleri::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.galeri.edit', compact('galeri', 'kategori'));
    }

    public function update(GaleriRequest $request, Galeri $galeri)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('file')) {
            $media = $this->mediaService->upload($request->file('file'), 'galeri', $request->judul);
            $validated['file_path'] = $media->file_path;
            $validated['file_type'] = $media->file_type;
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = Galeri::onlyTrashed()->with('kategoriGaleri')->latest()->paginate(10);
        return view('admin.galeri.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Galeri::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Galeri berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Galeri::onlyTrashed()->findOrFail($id);
        $item->forceDelete(); // Media physically stays if we don't delete from Media manager, or we can delete it. We'll leave it in media manager to be safe.
        return redirect()->back()->with('success', 'Galeri berhasil dihapus permanen.');
    }
}
