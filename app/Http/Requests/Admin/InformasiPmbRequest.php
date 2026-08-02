<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InformasiPmbRequest extends FormRequest
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
            'persyaratan' => 'nullable|string',
            'alur_pendaftaran' => 'nullable|string',
            'link_pendaftaran' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ];
    }
}
