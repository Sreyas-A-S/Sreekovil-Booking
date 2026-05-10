<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chant extends Model
{
    protected $fillable = ['text', 'meaning', 'is_active'];
}
