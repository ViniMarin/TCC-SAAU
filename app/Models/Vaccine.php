<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vaccine extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'animal_id',
        'vaccine_type',
        'application_date',
        'next_dose_date',
        'notes'
    ];

    protected $casts = [
        'application_date' => 'date',
        'next_dose_date' => 'date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
