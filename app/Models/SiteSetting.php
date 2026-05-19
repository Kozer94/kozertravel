<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'label', 'group'];

    public static function get(string $key, string $default = ''): string
    {
        $all = static::allCached();
        return $all[$key] ?? $default;
    }

    public static function set(string $key, string $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
        static::flushCache();
    }

    public static function allCached(): array
    {
        return Cache::remember('site_settings_all', 3600, fn () =>
            static::pluck('value', 'key')->toArray()
        );
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings_all');
    }
}
