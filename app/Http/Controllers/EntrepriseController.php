<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
{
    /**
     * Afficher la liste des annonces de l'entreprise
     */
    public function index()
    {
        $annonces = Annonce::orderBy('created_at', 'desc')->get();
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
        $annonce = Annonce::findOrFail($id);
        $categories = ['Électronique', 'Vêtements', 'Alimentation', 'Mobilier', 'Services', 'Autre'];
        return view('entreprise.edit', compact('annonce', 'categories'));
    }

    /**
     * Mettre à jour l'annonce
     */
    public function update(Request $request, $id)
    {
        $annonce = Annonce::findOrFail($id);

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
        $annonce = Annonce::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($annonce->image) {
            Storage::disk('public')->delete($annonce->image);
        }

        $annonce->delete();

        return redirect()->route('entreprise.index')->with('success', 'Annonce supprimée avec succès !');
    }
}