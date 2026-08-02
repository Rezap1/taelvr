<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'nullable|string|max:255',
                'file' => 'required|file|mimes:jpeg,png,jpg,webp,gif,svg,mp4,pdf,doc,docx,xls,xlsx|max:20480', // Max 20MB
                'alt_text' => 'nullable|string|max:255',
            ];
        }

        return [
            'title' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
        ];
    }
}
