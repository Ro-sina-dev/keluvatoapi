<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $req)
    {
        $term = trim((string) $req->get('q', ''));
        if ($term === '') {
            return response()->json([]);
        }

        $q = Product::query()
            ->where('is_active', true)
            ->where(function ($w) use ($term) {
                $w->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            })
            ->select(['id', 'name', 'price', 'currency', 'images']);

        // suggestions limitées (pour ta barre de recherche)
        return response()->json($q->limit(12)->get());
    }
}
