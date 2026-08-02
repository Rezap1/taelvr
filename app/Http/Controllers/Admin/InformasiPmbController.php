<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InformasiPmbRequest;
use App\Models\InformasiPmb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiPmbController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiPmb::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        return view('admin.informasi-pmb.index', compact('items'));
    }

    public function create()
    {
        return view('admin.informasi-pmb.create');
    }

    public function store(InformasiPmbRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = Str::slug($validated['judul']);

        // Check if slug exists, append random string if it does
        if (InformasiPmb::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . Str::random(5);
        }

        InformasiPmb::create($validated);

        return redirect()->route('admin.informasi-pmb.index')->with('success', 'Informasi PMB berhasil ditambahkan.');
    }

    public function show(InformasiPmb $informasiPmb)
    {
        return view('admin.informasi-pmb.show', ['item' => $informasiPmb]);
    }

    public function edit(InformasiPmb $informasiPmb)
    {
        return view('admin.informasi-pmb.edit', ['item' => $informasiPmb]);
    }

    public function update(InformasiPmbRequest $request, InformasiPmb $informasiPmb)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = Str::slug($validated['judul']);

        if (InformasiPmb::where('slug', $validated['slug'])->where('id', '!=', $informasiPmb->id)->exists()) {
            $validated['slug'] .= '-' . Str::random(5);
        }

        $informasiPmb->update($validated);

        return redirect()->route('admin.informasi-pmb.index')->with('success', 'Informasi PMB berhasil diperbarui.');
    }

    public function destroy(InformasiPmb $informasiPmb)
    {
        $informasiPmb->delete();
        return redirect()->route('admin.informasi-pmb.index')->with('success', 'Informasi PMB berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = InformasiPmb::onlyTrashed()->latest()->paginate(10);
        return view('admin.informasi-pmb.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = InformasiPmb::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Informasi PMB berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = InformasiPmb::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->back()->with('success', 'Informasi PMB berhasil dihapus permanen.');
    }
}
