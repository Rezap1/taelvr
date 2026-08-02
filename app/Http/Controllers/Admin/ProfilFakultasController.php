<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilFakultasRequest;
use App\Models\ProfilFakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilFakultasController extends Controller
{
    public function edit()
    {
        $profil = ProfilFakultas::first();
        if (!$profil) {
            $profil = ProfilFakultas::create([
                'judul' => 'Fakultas Teknik',
                'is_active' => true
            ]);
        }
        return view('admin.profil-fakultas.edit', compact('profil'));
    }

    public function update(ProfilFakultasRequest $request)
    {
        $profil = ProfilFakultas::first();
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar')) {
            if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
                Storage::disk('public')->delete($profil->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('profil', 'public');
        }

        if ($request->hasFile('foto_pimpinan')) {
            if ($profil->foto_pimpinan && Storage::disk('public')->exists($profil->foto_pimpinan)) {
                Storage::disk('public')->delete($profil->foto_pimpinan);
            }
            $data['foto_pimpinan'] = $request->file('foto_pimpinan')->store('profil', 'public');
        }

        if ($request->hasFile('struktur_organisasi')) {
            if ($profil->struktur_organisasi && Storage::disk('public')->exists($profil->struktur_organisasi)) {
                Storage::disk('public')->delete($profil->struktur_organisasi);
            }
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->back()->with('success', 'Profil Fakultas berhasil diperbarui.');
    }
}
