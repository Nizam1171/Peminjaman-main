<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'jenis_kelamin',
        'email',
        'password',
        'role',
        'status',
        'no_hp',
        'alamat',
        'foto_profile'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function peminjaman(): HasMany {
        return $this->hasMany(Peminjaman::class);
    }

    public function logAktivitas(): HasMany {
        return $this->hasMany(LogAktivitas::class);
    }
}
