<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->type == 1) {
            return redirect()->route('dossiers.administrateur');
        } elseif ($user->type == 2) {
            return redirect()->route('dossiers.entreprise');
        } elseif ($user->type == 3) {
            return redirect()->route('dossiers.acheteur');
        }

        return redirect()->route('auth.login')->with('error', 'Aucun profil d�fini pour cet utilisateur.');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function dologin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            switch ($user->type) {
                case '1':
                    return redirect()->route('dossiers.administrateur');
                case '2':
                    return redirect()->route('dossiers.entreprise');
                case '3':
                    return redirect()->route('dossiers.acheteur');
                default:
                    Auth::logout();
                    return redirect()->route('auth.login')->with('error', 'Aucun profil défini pour cet utilisateur.');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
        ]);
    }
    
    public function register(Request $request)
    {
        // 1. Validation
        $request->validate([
            'prenom'         => 'required|string|max:255',
            'nom'            => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users,email',
            'phone'          => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'gender'         => 'required|in:homme,femme,autre',
            'password'       => 'required|string|min:8|confirmed',
            'terms'          => 'accepted',
            'type'           => 'required|in:entreprise,acheteur,admin',
        ], [
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation.',
        ]);

        // 2. Mapping des types texte vers entier
        $typeMapping = [
            'admin'      => 1,
            'entreprise' => 2,
            'acheteur'   => 3
        ];

        $typeValue = $typeMapping[$request->type] ?? null;

        if ($typeValue === null) {
            return back()->withErrors(['type' => 'Type d’utilisateur invalide.'])->withInput();
        }

        // 3. Création utilisateur
        User::create([
            'prenom'         => $request->prenom,
            'nom'            => $request->nom,
            'email'          => $request->email,
            'telephone'      => $request->phone,
            'date_naissance' => $request->date_naissance,
            'gender'         => $request->gender,
            'newsletter'     => $request->has('newsletter'),
            'password'       => Hash::make($request->password),
            'type'           => $typeValue,
            'terms'          => $request->has('terms') ? 1 : 0
        ]);

        // 4. Redirection vers login avec message de succès
        return redirect()->route('auth.login')->with('success', 'Utilisateur créé avec succès. Vous pouvez maintenant vous connecter.');
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
