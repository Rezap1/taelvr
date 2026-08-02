<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biaya extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'biaya';

    protected $fillable = [
        'program_studi_id',
        'jenis_biaya',
        'nominal',
        'keterangan',
        'periode',
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
            'nominal' => 'decimal:2',
            'urutan' => 'integer',
        ];
    }

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('jenis_biaya');
    }
}
