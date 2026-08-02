<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'deskripsi' => 'nullable|string',
            'tingkat' => 'nullable|string|max:255',
            'peraih' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ];
    }
}
