<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JadwalPmbRequest;
use App\Models\JadwalPmb;
use Illuminate\Http\Request;

class JadwalPmbController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalPmb::query();

        if ($request->has('search')) {
            $query->where('kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('gelombang', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $items = $query->orderBy('urutan')->orderBy('tanggal_mulai')->paginate(10)->withQueryString();
        return view('admin.jadwal-pmb.index', compact('items'));
    }

    public function create()
    {
        return view('admin.jadwal-pmb.create');
    }

    public function store(JadwalPmbRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        JadwalPmb::create($validated);

        return redirect()->route('admin.jadwal-pmb.index')->with('success', 'Jadwal PMB berhasil ditambahkan.');
    }

    public function show(JadwalPmb $jadwalPmb)
    {
        return view('admin.jadwal-pmb.show', ['item' => $jadwalPmb]);
    }

    public function edit(JadwalPmb $jadwalPmb)
    {
        return view('admin.jadwal-pmb.edit', ['item' => $jadwalPmb]);
    }

    public function update(JadwalPmbRequest $request, JadwalPmb $jadwalPmb)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $jadwalPmb->update($validated);

        return redirect()->route('admin.jadwal-pmb.index')->with('success', 'Jadwal PMB berhasil diperbarui.');
    }

    public function destroy(JadwalPmb $jadwalPmb)
    {
        $jadwalPmb->delete();
        return redirect()->route('admin.jadwal-pmb.index')->with('success', 'Jadwal PMB berhasil dipindah ke tong sampah.');
    }

    public function trash()
    {
        $items = JadwalPmb::onlyTrashed()->latest()->paginate(10);
        return view('admin.jadwal-pmb.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = JadwalPmb::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->back()->with('success', 'Jadwal PMB berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $item = JadwalPmb::onlyTrashed()->findOrFail($id);
        $item->forceDelete();
        return redirect()->back()->with('success', 'Jadwal PMB berhasil dihapus permanen.');
    }
}
