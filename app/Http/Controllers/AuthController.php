<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'prenom'       => 'required|string|max:255',
            'nom'          => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'phone'        => 'required|string|max:20',
            'birth_date'   => 'required|date',
            'gender'       => 'required|in:homme,femme,autre',
            'password'     => 'required|string|min:8|confirmed',
            'terms'        => 'accepted',
        ], [
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation.',
        ]);

        User::create([
            'first_name'   => $request->prenom,
            'last_name'    => $request->nom,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'birth_date'   => $request->birth_date,
            'gender'       => $request->gender,
            'newsletter'   => $request->has('newsletter'), // booléen
            'password'     => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
