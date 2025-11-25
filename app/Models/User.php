<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Perfis possíveis:
     * - admin
     * - veterinario
     * - usuario  (usuário comum do painel)
     * - adotante (usuário do site público)
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // Helpers de papel
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isVet(): bool
    {
        return $this->role === 'veterinario';
    }

    public function isCommonUser(): bool
    {
        return $this->role === 'usuario';
    }
}
