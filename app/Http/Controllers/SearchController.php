<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    // GET /search/suggest -> JSON pour l'auto-complétion
    public function suggest(Request $request)
    {
        $term = trim($request->query('q', ''));
        if ($term === '') {
            return response()->json(['products' => [], 'categories' => []]);
        }

        $products = Product::query()
            ->where('is_active', true)
            ->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            })
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->limit(5)
            ->get();

        $categories = Category::query()
            ->where('name', 'like', "%{$term}%")
            ->orderBy('name')
            ->limit(5)
            ->get();

        $productPayload = $products->map(function ($p) {
            $imgs = (array) ($p->images ?? []);
            $img  = count($imgs) ? $imgs[0] : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&q=80&auto=format&fit=crop';
            $hasPromo = !is_null($p->discount_price ?? null);
            $display  = $hasPromo ? $p->discount_price : $p->price;

            return [
                'id'    => $p->id,
                'name'  => $p->name,
                'price' => number_format($display, 2, ',', ' ') . ' ' . ($p->currency ?? 'EUR'),
                'img'   => $img,
                'url'   => route('products.show', $p->id),
            ];
        });

        $categoryPayload = $categories->map(function ($c) {
            return [
                'id'   => $c->id,
                'name' => $c->name,
                'url'  => route('products.discover', ['category_id' => $c->id]),
            ];
        });

        return response()->json([
            'products'   => $productPayload,
            'categories' => $categoryPayload,
        ]);
    }

    // GET /search -> Page résultats
    public function results(Request $request)
    {
        $data = $request->validate(['q' => 'nullable|string|max:100']);
        $term = trim($data['q'] ?? '');

        $categoryMatches = collect();
        if ($term !== '') {
            $categoryMatches = Category::where('name', 'like', "%{$term}%")
                ->orderBy('name')
                ->limit(10)
                ->get();
        }

        $products = Product::query()
            ->where('is_active', true)
            ->when($term !== '', function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('name', 'like', "%{$term}%")
                       ->orWhere('description', 'like', "%{$term}%")
                       ->orWhereHas('categories', function ($cq) use ($term) {
                           $cq->where('name', 'like', "%{$term}%");
                       });
                });
            })
            ->orderByRaw('is_featured DESC')
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('search.results', compact('term', 'products', 'categoryMatches'));
    }
}
