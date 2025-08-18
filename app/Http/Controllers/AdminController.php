<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Annonce;
use App\Models\DemandeAchat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Tableau de bord principal
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_companies' => User::where('type', 'entreprise')->count(),
            'total_buyers' => User::where('type', 'acheteur')->count(),
            'total_orders' => DemandeAchat::count(),
            'total_annonces' => Annonce::count(),
            'pending_orders' => DemandeAchat::where('statut', 'en_attente')->count(),
        ];

        $recent_activities = $this->getRecentActivities();

        return view('admin.dashboard', compact('stats', 'recent_activities'));
    }

    /**
     * Gestion des utilisateurs
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required|in:admin,entreprise,acheteur'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Modifier un utilisateur
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'type' => 'required|in:admin,entreprise,acheteur',
            'status' => 'required|in:active,inactive,suspended'
        ]);

        $user->update($request->only(['name', 'email', 'type', 'status']));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Vérifier que ce n'est pas le dernier admin
        if ($user->type === 'admin' && User::where('type', 'admin')->count() <= 1) {
            return redirect()->route('admin.users')->with('error', 'Impossible de supprimer le dernier administrateur !');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès !');
    }

    /**
     * Gestion des entreprises
     */
    public function companies()
    {
        $companies = User::where('type', 'entreprise')
            ->withCount(['annonces'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.companies', compact('companies'));
    }

    /**
     * Gestion des acheteurs
     */
    public function buyers()
    {
        $buyers = User::where('type', 'acheteur')
            ->withCount(['demandesAchat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.buyers', compact('buyers'));
    }

    /**
     * Gestion des commandes/demandes
     */
    public function orders()
    {
        $orders = DemandeAchat::with(['annonce', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Mettre à jour le statut d'une commande
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,accepte,refuse,traite'
        ]);

        $order = DemandeAchat::findOrFail($id);
        $order->update(['statut' => $request->statut]);

        return redirect()->route('admin.orders')->with('success', 'Statut de la commande mis à jour !');
    }

    /**
     * Gestion des annonces
     */
    public function annonces()
    {
        $annonces = Annonce::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.annonces', compact('annonces'));
    }

    /**
     * Supprimer une annonce
     */
    public function deleteAnnonce($id)
    {
        $annonce = Annonce::findOrFail($id);
        
        // Supprimer l'image si elle existe
        if ($annonce->image) {
            Storage::disk('public')->delete($annonce->image);
        }

        $annonce->delete();

        return redirect()->route('admin.annonces')->with('success', 'Annonce supprimée avec succès !');
    }

    /**
     * Paramètres du système
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Mettre à jour les paramètres
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'maintenance_mode' => 'required|boolean'
        ]);

        // Ici vous pouvez sauvegarder dans une table settings ou dans un fichier de config
        // Pour cet exemple, on utilisera la session
        session()->put('site_settings', $request->only(['site_name', 'admin_email', 'maintenance_mode']));

        return redirect()->route('admin.settings')->with('success', 'Paramètres sauvegardés avec succès !');
    }

    /**
     * Obtenir les activités récentes
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Nouvelles inscriptions
        $recent_users = User::latest()->take(5)->get();
        foreach ($recent_users as $user) {
            $activities[] = [
                'user' => $user->name,
                'action' => 'Inscription ' . ucfirst($user->type),
                'date' => $user->created_at->format('d M Y, H:i'),
                'status' => $user->status ?? 'active'
            ];
        }

        // Nouvelles demandes
        $recent_orders = DemandeAchat::with('annonce')->latest()->take(3)->get();
        foreach ($recent_orders as $order) {
            $activities[] = [
                'user' => $order->nom_acheteur,
                'action' => 'Nouvelle Demande d\'achat',
                'date' => $order->created_at->format('d M Y, H:i'),
                'status' => $order->statut
            ];
        }

        // Trier par date
        usort($activities, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return array_slice($activities, 0, 10);
    }

    /**
     * API pour les statistiques (pour AJAX)
     */
    public function getStats()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_companies' => User::where('type', 'entreprise')->count(),
            'total_buyers' => User::where('type', 'acheteur')->count(),
            'total_orders' => DemandeAchat::count(),
            'pending_orders' => DemandeAchat::where('statut', 'en_attente')->count(),
            'monthly_growth' => $this->getMonthlyGrowth()
        ]);
    }

    /**
     * Calculer la croissance mensuelle
     */
    private function getMonthlyGrowth()
    {
        $current_month = User::whereMonth('created_at', now()->month)->count();
        $last_month = User::whereMonth('created_at', now()->subMonth()->month)->count();
        
        if ($last_month == 0) return 100;
        
        return round((($current_month - $last_month) / $last_month) * 100, 2);
    }
}