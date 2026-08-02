<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramStudiRequest;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramStudi::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kode', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->paginate(10)->withQueryString();
        return view('admin.program-studi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.program-studi.create');
    }

    public function store(ProgramStudiRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('program-studi', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('program-studi/icons', 'public');
        }

        ProgramStudi::create($data);
        return redirect()->route('admin.program-studi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.show', compact('programStudi'));
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    public function update(ProgramStudiRequest $request, ProgramStudi $programStudi)
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            if ($programStudi->gambar && Storage::disk('public')->exists($programStudi->gambar)) {
                Storage::disk('public')->delete($programStudi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('program-studi', 'public');
        }
        if ($request->hasFile('icon')) {
            if ($programStudi->icon && Storage::disk('public')->exists($programStudi->icon)) {
                Storage::disk('public')->delete($programStudi->icon);
            }
            $data['icon'] = $request->file('icon')->store('program-studi/icons', 'public');
        }

        $programStudi->update($data);
        return redirect()->route('admin.program-studi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();
        return redirect()->route('admin.program-studi.index')->with('success', 'Data berhasil dihapus (Soft Delete).');
    }

    public function trash()
    {
        $items = ProgramStudi::onlyTrashed()->paginate(10);
        return view('admin.program-studi.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = ProgramStudi::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = ProgramStudi::onlyTrashed()->findOrFail($id);
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
