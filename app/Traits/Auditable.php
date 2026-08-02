<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait Auditable
 *
 * Otomatis mengisi created_by, updated_by, dan deleted_by
 * berdasarkan user yang sedang login.
 */
trait Auditable
{
    public static function bootAuditable(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && $model->isFillable('created_by')) {
                $model->created_by = $model->created_by ?? Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check() && $model->isFillable('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        // SoftDeletes: isi deleted_by saat menghapus
        if (method_exists(static::class, 'bootSoftDeletes')) {
            static::deleting(function ($model) {
                if (Auth::check() && $model->isFillable('deleted_by')) {
                    $model->deleted_by = Auth::id();
                    $model->saveQuietly();
                }
            });
        }
    }

    /**
     * Relasi ke user yang membuat.
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * Relasi ke user yang mengupdate.
     */
    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    /**
     * Relasi ke user yang menghapus.
     */
    public function deleter()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }
}
