<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrestasiRequest;
use App\Models\Prestasi;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('peraih', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        return view('admin.prestasi.index', compact('items'));
    }

    public function create()
    {
        $programStudi = ProgramStudi::active()->ordered()->get();
        return view('admin.prestasi.create', compact('programStudi'));
    }

    public function store(PrestasiRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        Prestasi::create($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Prestasi $prestasi)
    {
        return view('admin.prestasi.show', compact('prestasi'));
    }

    public function edit(Prestasi $prestasi)
    {
        $programStudi = ProgramStudi::active()->ordered()->get();
        return view('admin.prestasi.edit', compact('prestasi', 'programStudi'));
    }

    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
                Storage::disk('public')->delete($prestasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        $prestasi->update($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Data berhasil dihapus (Soft Delete).');
    }

    public function trash()
    {
        $items = Prestasi::onlyTrashed()->paginate(10);
        return view('admin.prestasi.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Prestasi::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Prestasi::onlyTrashed()->findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->forceDelete();
        return redirect()->back()->with('success', 'Data berhasil dihapus permanen.');
    }
}
