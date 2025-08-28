<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Récupère les produits favoris (actifs) via la table favorites
        $favoriteProducts = \App\Models\Product::query()
            ->whereIn('id', Favorite::where('user_id', $userId)->pluck('product_id'))
            ->where('is_active', true)
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('favorites.index', compact('favoriteProducts'));
    }
}
