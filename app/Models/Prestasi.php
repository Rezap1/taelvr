<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'prestasi';

    protected $fillable = [
        'judul',
        'program_studi_id',
        'slug',
        'deskripsi',
        'tingkat',
        'peraih',
        'tanggal',
        'gambar',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'tanggal' => 'date',
        ];
    }

    // =========================================================================
    // Boot — Auto-generate slug
    // =========================================================================

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul') && ! $model->isDirty('slug')) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    // =========================================================================
    // Scopes
    // =========================================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
