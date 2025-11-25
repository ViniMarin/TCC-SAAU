<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'raffle_id',
        'number',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
