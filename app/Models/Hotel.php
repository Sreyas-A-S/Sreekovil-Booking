<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['temple_id', 'name', 'contact_number', 'details', 'onwards_price', 'photos'];

    protected $casts = [
        'photos' => 'array',
    ];

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }
}
