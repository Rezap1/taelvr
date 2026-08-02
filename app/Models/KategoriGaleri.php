<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriGaleri extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'kategori_galeri';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'is_active',
        'urutan',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama') && ! $model->isDirty('slug')) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'kategori_galeri_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }
}
