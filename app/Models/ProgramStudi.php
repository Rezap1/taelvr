<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProgramStudi extends Model
{
    use Auditable, SoftDeletes, \App\Traits\ClearsCache;

    protected $table = 'program_studi';

    protected $fillable = [
        'nama',
        'kaprodi',
        'slug',
        'kode',
        'jenjang',
        'akreditasi',
        'kuota',
        'deskripsi',
        'prospek_karir',
        'gambar',
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
            'is_active' => 'boolean',
            'kuota' => 'integer',
            'urutan' => 'integer',
        ];
    }

    // =========================================================================
    // Boot — Auto-generate slug
    // =========================================================================

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

    // =========================================================================
    // Relationships
    // =========================================================================

    public function biaya(): HasMany
    {
        return $this->hasMany(Biaya::class, 'program_studi_id');
    }

    // =========================================================================
    // Scopes
    // =========================================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }


}
