<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BiayaRequest;
use App\Models\Biaya;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function index(Request $request)
    {
        $query = Biaya::with('programStudi');

        if ($request->has('search')) {
            $query->where('jenis_biaya', 'like', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'like', '%' . $request->search . '%');
        }

        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('program_studi_id', $request->prodi);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('program_studi_id')->orderBy('urutan')->paginate(10)->withQueryString();
        $prodi = ProgramStudi::where('is_active', true)->orderBy('nama')->get();
        
        return view('admin.biaya.index', compact('items', 'prodi'));
    }

    public function create()
    {
        $prodi = ProgramStudi::where('is_active', true)->orderBy('nama')->get();
        return view('admin.biaya.create', compact('prodi'));
    }

    public function store(BiayaRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        Biaya::create($validated);

        return redirect()->route('admin.biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }

    public function show(Biaya $biaya)
    {
        $biaya->load('programStudi');
        return view('admin.biaya.show', ['item' => $biaya]);
    }

    public function edit(Biaya $biaya)
    {
        $prodi = ProgramStudi::where('is_active', true)->orderBy('nama')->get();
        return view('admin.biaya.edit', ['item' => $biaya, 'prodi' => $prodi]);
    }

    public function update(BiayaRequest $request, Biaya $biaya)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $biaya->update($validated);

        return redirect()->route('admin.biaya.index')->with('success', 'Biaya berhasil diperbarui.');
    }

    public function destroy(Biaya $biaya)
    {
        $biaya->delete();
        return redirect()->route('admin.biaya.index')->with('success', 'Biaya berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = Biaya::onlyTrashed()->with('programStudi')->latest()->paginate(10);
        return view('admin.biaya.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Biaya::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Biaya berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = Biaya::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->back()->with('success', 'Biaya berhasil dihapus permanen.');
    }
}
