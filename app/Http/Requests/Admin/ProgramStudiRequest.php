<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramStudiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'kaprodi' => 'nullable|string|max:255',
            'kode' => 'nullable|string|max:20',
            'jenjang' => 'required|string|max:10',
            'akreditasi' => 'nullable|string|max:20',
            'kuota' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0',
        ];
    }
}
