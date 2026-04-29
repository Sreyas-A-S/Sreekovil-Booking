<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['temple_id', 'name', 'slug', 'contact_number', 'details', 'onwards_price', 'photos'];

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
        static::saving(function ($hotel) {
            if (empty($hotel->slug)) {
                $hotel->slug = \Illuminate\Support\Str::slug($hotel->name);
            }
        });
    }

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}
