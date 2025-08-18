<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\DemandeAchat;

class AcheteurController extends Controller
{
    /**
     * Afficher toutes les annonces disponibles
     */
    public function index(Request $request)
    {
        $query = Annonce::query();

        // Filtrage par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Filtrage par localisation
        if ($request->filled('localisation')) {
            $query->where('localisation', 'like', '%' . $request->localisation . '%');
        }

        // Filtrage par prix
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        // Recherche par titre
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        $annonces = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Annonce::distinct()->pluck('categorie');

        return view('dossiers.acheteur', compact('annonces', 'categories'));
    }

    /**
     * Envoyer une demande d'achat
     */
    public function envoyerDemande(Request $request, $id)
    {
        $request->validate([
            'nom_acheteur' => 'required|string|max:255',
            'email_acheteur' => 'required|email|max:255',
            'telephone_acheteur' => 'required|string|max:20',
            'quantite_demandee' => 'required|integer|min:1',
            'message' => 'nullable|string|max:1000'
        ]);

        $annonce = Annonce::findOrFail($id);

        // Vérifier si la quantité demandée est disponible
        if ($request->quantite_demandee > $annonce->quantite) {
            return back()->with('error', 'Quantité demandée supérieure à la quantité disponible.');
        }

        DemandeAchat::create([
            'annonce_id' => $id,
            'nom_acheteur' => $request->nom_acheteur,
            'email_acheteur' => $request->email_acheteur,
            'telephone_acheteur' => $request->telephone_acheteur,
            'quantite_demandee' => $request->quantite_demandee,
            'message' => $request->message,
            'statut' => 'en_attente'
        ]);

        return back()->with('success', 'Votre demande d\'achat a été envoyée avec succès !');
    }

    /**
     * Afficher les demandes de l'acheteur
     */
    public function mesDemandes(Request $request)
    {
        $email = $request->get('email');
        
        if (!$email) {
            return view('acheteur.mes-demandes', [
                'demandes' => collect(),
                'email' => null
            ]);
        }

        $demandes = DemandeAchat::with('annonce')
            ->where('email_acheteur', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('acheteur.mes-demandes', compact('demandes', 'email'));
    }

    /**
     * Afficher les détails d'une demande
     */
    public function detailsDemande($id)
    {
        $demande = DemandeAchat::with('annonce')->findOrFail($id);
        return view('acheteur.details-demande', compact('demande'));
    }
}