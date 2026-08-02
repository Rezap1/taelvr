<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'link' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'urutan' => 'integer|min:0',
        ];

        if ($this->isMethod('post')) {
            $rules['file'] = 'required|file|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['file'] = 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }
}
