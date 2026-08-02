<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:alamat,telepon,email,whatsapp,fax',
            'label' => 'required|string|max:255',
            'nilai' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0',
        ];
    }
}
