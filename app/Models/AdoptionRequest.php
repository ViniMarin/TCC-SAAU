<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AdoptionRequest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'animal_id',
        'full_name',
        'email',
        'phone',
        'city_state',
        'housing_type',
        'had_pets',
        'message',
        'status',
        // se você tiver a coluna:
        'admin_notes',
    ];

    protected $casts = [
        'request_date' => 'date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors "adopter_*" usados nas views admin
    |--------------------------------------------------------------------------
    | Assim, tanto full_name/email/phone/city_state quanto adopter_*
    | passam a funcionar.
    */

    public function getAdopterNameAttribute()
    {
        return $this->full_name;
    }

    public function getAdopterEmailAttribute()
    {
        return $this->email;
    }

    public function getAdopterPhoneAttribute()
    {
        return $this->phone;
    }

    public function getAdopterAddressAttribute()
    {
        return $this->city_state;
    }
}
