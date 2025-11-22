<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AdoptionStory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'adopter_name',
        'animal_name',
        'story',
        'photo_url',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];
}
