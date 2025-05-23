<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'completed',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'completed' => 'boolean',
    ];
}
