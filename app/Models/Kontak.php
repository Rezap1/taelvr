<?php

namespace App\Models;

use App\Enums\ContactType;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'kontak';

    protected $fillable = [
        'type',
        'label',
        'nilai',
        'icon',
        'is_active',
        'urutan',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'type' => ContactType::class,
            'is_active' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
