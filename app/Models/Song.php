<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title',
        'singer',
        'album',
        'author',
        'file_path',
        'duration',
    ];

    public function temples()
    {
        return $this->hasMany(Temple::class, 'idle_song_id');
    }
}
