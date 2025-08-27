<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
   public function index()
    {
        // Récupérer les commandes de l'utilisateur connecté
        $orders = Order::where('user_id', Auth::id())
                        ->with('items') // pour charger les produits liés
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Envoyer la variable à la vue
        return view('orders', compact('orders'));
    }
}
