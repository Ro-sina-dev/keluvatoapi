<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔹 Inscription client
    public function registerClient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'email' => 'required|string|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'country' => 'required|string|max:100', // ✅ Ajout du pays
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'client';

        $user = User::create($validated);

        // Création du token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => "Bienvenue {$user->name}, vous êtes inscrit en tant que {$user->role_label}.",
            'token' => $token,
            'user' => $user
        ], 201);
    }

    // 🔹 Inscription pro
    public function registerPro(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'creation_date' => 'nullable|date',
            'email' => 'required|string|email|unique:users',
            'country' => 'required|string|max:100', // ✅ Ajout du pays
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pro';

        // pour un pro, crée un "name" par défaut si besoin
        $validated['name'] = $request->input('name', $validated['company_name']);


        $user = User::create($validated);

        // Création du token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => "Bienvenue {$user->name}, vous êtes inscrit en tant que {$user->role_label}.",
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }

    // 🔹 Connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Utilisation explicite du guard web
        if (!Auth::guard('web')->attempt($credentials)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // nouveau token à chaque login (optionnel : révoquer les anciens)
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => "Connexion réussie. Bonjour {$user->name}, vous êtes connecté en tant que {$user->role_label}.",
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // Qui suis-je ?
    // app/Http/Controllers/AuthController.php (extraits)
    public function me(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        if ($token) $token->delete();
        return response()->json(['message' => 'Déconnecté']);
    }
}
