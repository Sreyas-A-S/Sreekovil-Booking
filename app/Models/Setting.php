<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static $cachedSettings = null;

    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return ($setting && $setting->value) ? $setting->value : $default;
    }
}
