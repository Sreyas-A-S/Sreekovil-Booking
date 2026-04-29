<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temple extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'location', 'photos', 'idle_song_id'];

    protected $casts = [
        'photos' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($temple) {
            if (empty($temple->slug)) {
                $temple->slug = \Illuminate\Support\Str::slug($temple->name);
            }
        });
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function idleSong()
    {
        return $this->belongsTo(Song::class, 'idle_song_id');
    }
}
