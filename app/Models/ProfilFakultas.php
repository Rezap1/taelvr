<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class ProfilFakultas extends Model
{
    use Auditable;

    protected $table = 'profil_fakultas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'visi',
        'misi',
        'tujuan',
        'nama_pimpinan',
        'foto_pimpinan',
        'struktur_organisasi',
        'sejarah',
        'gambar',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // =========================================================================
    // Scopes
    // =========================================================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
