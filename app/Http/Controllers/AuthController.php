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
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'client';

        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function registerPro(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'creation_date' => 'nullable|date',
            'email' => 'required|email|unique:users',
            'country' => 'required|string|max:100',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pro';
        $validated['name'] = $request->input('company_name');

        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('home');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    // 🐛 Log avant tentative de connexion
    \Log::info('Tentative de connexion:', [
        'email' => $credentials['email'],
        'password_provided' => !empty($credentials['password'])
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 🐛 Log après connexion réussie
        \Log::info('Connexion réussie:', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'name' => $user->name
        ]);

        if ($user->role === 'admin') {
            \Log::info('Redirection vers admin dashboard');
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pro') {
            \Log::info('Redirection vers profile');
            return redirect()->route('profile');
        }

        \Log::info('Redirection vers home');
        return redirect()->route('home');
    }

    // 🐛 Log si échec de connexion
    \Log::warning('Échec de connexion:', [
        'email' => $credentials['email'],
        'user_exists' => \App\Models\User::where('email', $credentials['email'])->exists()
    ]);

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ])->onlyInput('email');
}


    // Qui suis-je ?
    // app/Http/Controllers/AuthController.php (extraits)
    // public function me(Request $request)
    // {
    //      return response()->json(['user' => $request->user()]);
    //  }

    // public function logout(Request $request)
    // {
    //    $token = $request->user()->currentAccessToken();
    //    if ($token) $token->delete();
    //    return response()->json(['message' => 'Déconnecté']);
    //}
}
