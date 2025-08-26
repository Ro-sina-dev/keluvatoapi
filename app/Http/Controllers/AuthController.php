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
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // vers la vue admin
            } elseif ($user->role === 'pro') {
                return redirect()->route('profile'); // vers profil pro
            } else {
                return redirect()->route('home'); // utilisateur simple
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
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
