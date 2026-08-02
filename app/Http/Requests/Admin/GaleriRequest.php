<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'kategori_galeri_id' => 'required|exists:kategori_galeri,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0',
        ];

        if ($this->isMethod('post')) {
            $rules['file'] = 'required|file|mimes:jpeg,png,jpg,webp,mp4|max:20480';
        } else {
            $rules['file'] = 'nullable|file|mimes:jpeg,png,jpg,webp,mp4|max:20480';
        }

        return $rules;
    }
}
