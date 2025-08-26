<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        // Exemple de traitement (paiement fictif ici)
        session()->forget('cart'); // vide le panier après commande
        return redirect()->route('home')->with('success', 'Paiement effectué avec succès !');
    }
}
