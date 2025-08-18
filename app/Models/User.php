<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs pouvant être assignés en masse.
     */
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'date_naissance',
        'sexe',
        'newsletter',
        'password',
        'type', // 1: Admin, 2: Entreprise, 3: Acheteur
        'terms', // Acceptation des termes et conditions
    ];

    /**
     * Les attributs à masquer lors de la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à caster automatiquement.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance' => 'date',
        'newsletter' => 'boolean',
    ];
}
