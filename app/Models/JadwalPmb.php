<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPmb extends Model
{
    use Auditable, SoftDeletes;

    protected $table = 'jadwal_pmb';

    protected $fillable = [
        'gelombang',
        'kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
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
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'urutan' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('tanggal_mulai');
    }
}
