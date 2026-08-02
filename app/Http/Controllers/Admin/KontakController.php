<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KontakRequest;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $query = Kontak::query();

        if ($request->has('search')) {
            $query->where('label', 'like', '%' . $request->search . '%')
                  ->orWhere('nilai', 'like', '%' . $request->search . '%');
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('type')->orderBy('urutan')->paginate(10)->withQueryString();
        
        return view('admin.kontak.index', compact('items'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(KontakRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        Kontak::create($validated);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function show(Kontak $kontak)
    {
        return view('admin.kontak.show', ['item' => $kontak]);
    }

    public function edit(Kontak $kontak)
    {
        return view('admin.kontak.edit', ['item' => $kontak]);
    }

    public function update(KontakRequest $request, Kontak $kontak)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $kontak->update($validated);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = Kontak::onlyTrashed()->latest()->paginate(10);
        return view('admin.kontak.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Kontak::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Kontak berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Kontak::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->back()->with('success', 'Kontak berhasil dihapus permanen.');
    }
}
