<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'active',
        'image_url'
    ];

    protected $casts = [
        'date' => 'date',
        'active' => 'boolean',
    ];
}
