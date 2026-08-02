<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'target' => 'required|string|in:_self,_blank',
            'icon' => 'nullable|string|max:255',
            'permission' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'integer|min:0',
            'type' => 'required|string|in:header,footer',
            'is_active' => 'boolean',
        ];
    }
}
