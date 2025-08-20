<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\DemandeAchat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    /**
     * Constructeur pour s'assurer que l'utilisateur est connecté
     */
    // public function __construct()
    // {
    //     $this->middleware('AuthCheck');
    // }

    /**
     * Afficher la liste des annonces de l'entreprise connectée UNIQUEMENT
     */
    public function index()
    {
        // Récupérer SEULEMENT les annonces de l'entreprise connectée
        $annonces = Annonce::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dossiers.entreprise', compact('annonces'));
    }

    /**
     * Afficher le formulaire de création d'annonce
     */
    public function create()
    {
        $categories = ['Électronique', 'Vêtements', 'Alimentation', 'Mobilier', 'Services', 'Autre'];
        return view('entreprise.create', compact('categories'));
    }

    /**
     * Enregistrer une nouvelle annonce
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'localisation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['titre', 'description', 'categorie', 'quantite', 'prix', 'localisation']);
        
        // IMPORTANT : Associer l'annonce à l'entreprise connectée
        $data['user_id'] = Auth::id();

        // Gérer l'upload d'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');
            $data['image'] = $imagePath;
        }

        Annonce::create($data);

        return redirect()->route('entreprise.index')->with('success', 'Annonce créée avec succès !');
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        // S'assurer que l'annonce appartient à l'entreprise connectée
        $annonce = Annonce::where('user_id', Auth::id())
            ->findOrFail($id);
            
        $categories = ['Électronique', 'Vêtements', 'Alimentation', 'Mobilier', 'Services', 'Autre'];
        return view('entreprise.edit', compact('annonce', 'categories'));
    }

    /**
     * Mettre à jour l'annonce
     */
    public function update(Request $request, $id)
    {
        // S'assurer que l'annonce appartient à l'entreprise connectée
        $annonce = Annonce::where('user_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'localisation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['titre', 'description', 'categorie', 'quantite', 'prix', 'localisation']);

        // Gérer l'upload d'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($annonce->image) {
                Storage::disk('public')->delete($annonce->image);
            }
            $imagePath = $request->file('image')->store('annonces', 'public');
            $data['image'] = $imagePath;
        }

        $annonce->update($data);

        return redirect()->route('entreprise.index')->with('success', 'Annonce mise à jour avec succès !');
    }

    /**
     * Supprimer l'annonce
     */
    public function destroy($id)
    {
        // S'assurer que l'annonce appartient à l'entreprise connectée
        $annonce = Annonce::where('user_id', Auth::id())
            ->findOrFail($id);

        // Supprimer l'image si elle existe
        if ($annonce->image) {
            Storage::disk('public')->delete($annonce->image);
        }

        $annonce->delete();

        return redirect()->route('entreprise.index')->with('success', 'Annonce supprimée avec succès !');
    }

    /**
     * Afficher les demandes d'achat reçues pour les annonces de l'entreprise connectée
     */
    public function demandes()
    {
        $demandes = DemandeAchat::whereHas('annonce', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('annonce')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('entreprise.demandes', compact('demandes'));
    }

    /**
     * Mettre à jour le statut d'une demande
     */
    public function updateStatutDemande(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,accepte,refuse,traite'
        ]);

        // S'assurer que la demande concerne une annonce de l'entreprise connectée
        $demande = DemandeAchat::whereHas('annonce', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);
            
        $demande->update(['statut' => $request->statut]);

        return redirect()->route('entreprise.demandes')->with('success', 'Statut de la demande mis à jour !');
    }
}