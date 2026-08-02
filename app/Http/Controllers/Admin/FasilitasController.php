<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = Fasilitas::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->paginate(10)->withQueryString();
        return view('admin.fasilitas.index', compact('items'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(FasilitasRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('fasilitas/icons', 'public');
        }

        Fasilitas::create($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.show', ['fasilitas' => $fasilita]);
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.edit', ['fasilitas' => $fasilita]);
    }

    public function update(FasilitasRequest $request, Fasilitas $fasilita)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            if ($fasilita->gambar && Storage::disk('public')->exists($fasilita->gambar)) {
                Storage::disk('public')->delete($fasilita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }
        if ($request->hasFile('icon')) {
            if ($fasilita->icon && Storage::disk('public')->exists($fasilita->icon)) {
                Storage::disk('public')->delete($fasilita->icon);
            }
            $data['icon'] = $request->file('icon')->store('fasilitas/icons', 'public');
        }

        $fasilita->update($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();
        return redirect()->route('admin.fasilitas.index')->with('success', 'Data berhasil dihapus (Soft Delete).');
    }

    public function trash()
    {
        $items = Fasilitas::onlyTrashed()->paginate(10);
        return view('admin.fasilitas.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Fasilitas::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Fasilitas::onlyTrashed()->findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        if ($item->icon && Storage::disk('public')->exists($item->icon)) {
            Storage::disk('public')->delete($item->icon);
        }
        $item->forceDelete();
        return redirect()->back()->with('success', 'Data berhasil dihapus permanen.');
    }
}
