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

    /**
     * Sempre devolver uma URL válida da foto.
     *
     * No banco pode estar:
     *  - "stories/arquivo.jpg"  (caminho relativo)
     *  - "/storage/alguma-coisa.jpg"
     *  - "https://..."
     */
    public function getPhotoUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Já é URL completa ou já começa com /storage
        if (str_starts_with($value, 'http') || str_starts_with($value, '/storage')) {
            return $value;
        }

        // Caminho relativo salvo no disco "public"
        return asset('storage/' . ltrim($value, '/'));
    }
}
