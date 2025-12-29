<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key, or return default.
     */
    public static function get(string $key, $default = null)
    {
        $row = static::where('key', $key)->first();

        return $row ? $row->value : $default;
    }

    /**
     * Get a setting value as boolean.
     */
    public static function getBool(string $key, bool $default = false): bool
    {
        $value = static::get($key, null);
        if ($value === null) return $default;
        return in_array($value, ['1', 'true', 'yes', 'on'], true);
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => is_bool($value) ? ($value ? '1' : '0') : (string) $value]
        );
    }

    /**
     * Return all settings as associative array key => value
     */
    public static function allToArray(): array
    {
        return static::query()->pluck('value', 'key')->toArray();
    }
}
