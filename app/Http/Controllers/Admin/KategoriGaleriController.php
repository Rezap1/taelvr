<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriGaleriRequest;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;

class KategoriGaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriGaleri::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->paginate(10)->withQueryString();
        return view('admin.kategori-galeri.index', compact('items'));
    }

    public function create()
    {
        return view('admin.kategori-galeri.create');
    }

    public function store(KategoriGaleriRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        KategoriGaleri::create($data);
        return redirect()->route('admin.kategori-galeri.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(KategoriGaleri $kategori_galeri)
    {
        return view('admin.kategori-galeri.show', compact('kategori_galeri'));
    }

    public function edit(KategoriGaleri $kategori_galeri)
    {
        return view('admin.kategori-galeri.edit', compact('kategori_galeri'));
    }

    public function update(KategoriGaleriRequest $request, KategoriGaleri $kategori_galeri)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        $kategori_galeri->update($data);
        return redirect()->route('admin.kategori-galeri.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(KategoriGaleri $kategori_galeri)
    {
        $kategori_galeri->delete();
        return redirect()->route('admin.kategori-galeri.index')->with('success', 'Data berhasil dihapus (Soft Delete).');
    }

    public function trash()
    {
        $items = KategoriGaleri::onlyTrashed()->paginate(10);
        return view('admin.kategori-galeri.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = KategoriGaleri::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = KategoriGaleri::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->back()->with('success', 'Data berhasil dihapus permanen.');
    }
}
