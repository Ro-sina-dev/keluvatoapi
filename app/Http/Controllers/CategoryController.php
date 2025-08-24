<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str; // ✅ IMPORTANT

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with(['children:id,parent_id,name'])
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get(['id','name']);
    }

  public function forDisplay()
{
    // 1) Récupère seulement les catégories racines qui ont des produits actifs
    //    (directement OU via leurs enfants)
    $categories = Category::query()
        ->whereNull('parent_id')
        ->where(function ($q) {
            $q->whereHas('products', fn($p) => $p->where('is_active', true))
              ->orWhereHas('children.products', fn($p) => $p->where('is_active', true));
        })
        // Compte les produits actifs directs de la racine
        ->withCount([
            'products as direct_products_count' => fn($p) => $p->where('is_active', true),
        ])
        // Charge les enfants qui ont au moins 1 produit actif + compte leurs produits
        ->with(['children' => function ($q) {
            $q->whereHas('products', fn($p) => $p->where('is_active', true))
              ->withCount([
                  'products as products_count' => fn($p) => $p->where('is_active', true),
              ])
              ->orderBy('name');
        }])
        ->orderBy('name')
        ->get(['id', 'name', 'cover_url']); // cover_url si tu l’utilises

    // 2) Petit helper pour piocher une image depuis la BDD (produits liés)
    $pickFirstImage = function (Category $cat) {
        // Essaye un produit de la catégorie racine
        $first = $cat->products()->where('is_active', true)->latest()->first();
        if ($first && is_array($first->images) && !empty($first->images[0])) {
            return $first->images[0];
        }
        // Sinon, parcours les enfants
        foreach ($cat->children as $child) {
            $cp = $child->products()->where('is_active', true)->latest()->first();
            if ($cp && is_array($cp->images) && !empty($cp->images[0])) {
                return $cp->images[0];
            }
        }
        return null;
    };

    // 3) Normalise la sortie pour le front
    $out = $categories->map(function ($category) use ($pickFirstImage) {
        $total = (int) ($category->direct_products_count ?? 0)
               + (int) $category->children->sum('products_count');

        $img = $category->cover_url ?: $pickFirstImage($category) ?: 'https://picsum.photos/600/400';

        return [
            'id'             => $category->id,
            'name'           => $category->name,
            'slug'           => \Illuminate\Support\Str::slug($category->name),
            'products_count' => $total,
            'image'          => $img,
            'children'       => $category->children->map(function ($child) {
                return [
                    'id'             => $child->id,
                    'name'           => $child->name,
                    'slug'           => \Illuminate\Support\Str::slug($child->name),
                    'products_count' => (int) $child->products_count,
                ];
            })->values(),
        ];
    })->values();

    return response()->json($out);
}


    public function show($id)
    {
        $category = Category::with([
            'children:id,parent_id,name',
            'products' => function ($q) {
                $q->where('is_active', true)
                  ->latest()
                  ->select('id','name','description','price','currency','images','stock','is_active');
            }
        ])->findOrFail($id);

        return response()->json($category);
    }

    public function getProducts($id, Request $request)
    {
        $category = Category::with('children:id,parent_id')->findOrFail($id); // ✅ eager

        $categoryIds = [$category->id];
        if ($category->children->isNotEmpty()) {
            $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
        }

        $query = \App\Models\Product::query()
            ->with('categories:id,name')
            ->where('is_active', true)
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });

        switch ($request->input('sort')) {
            case 'price-asc':  $query->orderBy('price'); break;
            case 'price-desc': $query->orderByDesc('price'); break;
            default:           $query->latest();
        }

        $products = $query->paginate($request->integer('per_page', 20));

        return response()->json([
            'category' => $category->load('children:id,parent_id,name'),
            'products' => $products,
        ]);
    }
}
