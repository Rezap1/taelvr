<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'galeri';

    protected $fillable = [
        'kategori_galeri_id',
        'judul',
        'deskripsi',
        'file_path',
        'file_type',
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

    public function kategoriGaleri(): BelongsTo
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_galeri_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('judul');
    }
}
