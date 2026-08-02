<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearsCache
{
    protected static function bootClearsCache()
    {
        static::saved(function ($model) {
            Cache::flush();
        });

        static::deleted(function ($model) {
            Cache::flush();
        });
    }
}
