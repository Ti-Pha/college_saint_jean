<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'content',
        'photo',
        'rating',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating'    => 'integer',
        'order'     => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}