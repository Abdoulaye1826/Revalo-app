<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchat extends Model
{
    use HasFactory;

    protected $table = 'demandes_achat';

    protected $fillable = [
        'annonce_id',
        'nom_acheteur',
        'email_acheteur',
        'telephone_acheteur',
        'quantite_demandee',
        'message',
        'statut'
    ];

    protected $casts = [
        'quantite_demandee' => 'integer'
    ];

    /**
     * Relation avec l'annonce
     */
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    /**
     * Scope pour filtrer par statut
     */
    public function scopeStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    /**
     * Accessor pour le statut formaté
     */
    public function getStatutFormatteAttribute()
    {
        $statuts = [
            'en_attente' => 'En attente',
            'accepte' => 'Accepté',
            'refuse' => 'Refusé',
            'traite' => 'Traité'
        ];

        return $statuts[$this->statut] ?? $this->statut;
    }
}