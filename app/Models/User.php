<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'phone',
        'country',
        'company_name',
        'creation_date',
        'password',
        'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'creation_date' => 'date',
        'password' => 'hashed',
    ];

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'administrateur',
            'pro'   => 'professionnel',
            default => 'utilisateur simple',
        };
    }

    // app/Models/User.php
public function favorites() {
    return $this->belongsToMany(\App\Models\Product::class, 'favorites')->withTimestamps();
}

}
