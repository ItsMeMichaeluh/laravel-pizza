<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['items', 'total'];

    protected $casts = [
        'items' => 'array', // Automatisch JSON omzetten naar array
    ];
}
