<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Donation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'date',
        'amount',
        'type',
        'donor_name',
        'donor_email',
        'description'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
}
