<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfilFakultasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'nama_pimpinan' => 'nullable|string|max:255',
            'foto_pimpinan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sejarah' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ];
    }
}
