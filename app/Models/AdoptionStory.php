<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AdoptionStory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'animal_id',
        'user_id',
        'title',
        'story',
        'adoption_date',
        'photo_url'
    ];

    protected $casts = [
        'adoption_date' => 'date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
