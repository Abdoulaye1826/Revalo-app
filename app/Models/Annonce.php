<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'categorie',
        'quantite',
        'prix',
        'localisation',
        'image',
        'user_id',
        'status', 
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'quantite' => 'integer'
    ];

    /**
     * Relation avec les demandes d'achat
     */
    public function demandesAchat()
    {
        return $this->hasMany(DemandeAchat::class);
    }

    /**
     * Scope pour filtrer par catégorie
     */
    public function scopeCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    /**
     * Scope pour filtrer par prix
     */
    public function scopePrixEntre($query, $min, $max)
    {
        return $query->whereBetween('prix', [$min, $max]);
    }

    /**
     * Scope pour rechercher dans le titre
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where('titre', 'like', '%' . $terme . '%')
                    ->orWhere('description', 'like', '%' . $terme . '%');
    }

    /**
     * Accessor pour formater le prix
     */
    public function getPrixFormatteAttribute()
    {
        return number_format($this->prix, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// ================================================================
