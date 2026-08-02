<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BiayaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_studi_id' => 'required|exists:program_studi,id',
            'jenis_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'periode' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0',
        ];
    }
}
