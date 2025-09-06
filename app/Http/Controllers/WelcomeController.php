<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Récupérer les catégories avec leurs enfants et leurs produits
        $categories = Category::with([
            'children:id,parent_id,name',
            'products' => function ($q) {
                $q->where('is_active', true)
                  ->select('id', 'name', 'description', 'price', 'currency', 'images', 'stock', 'is_active')
                  ->latest();
            },
            'children.products' => function ($q) {
                $q->where('is_active', true)
                  ->select('id', 'name', 'description', 'price', 'currency', 'images', 'stock', 'is_active')
                  ->latest();
            }
        ])
        ->whereNull('parent_id')
        ->withCount([
            'products as direct_products_count' => function ($q) {
                $q->where('is_active', true);
            }
        ])
        ->orderBy('name')
        ->get(['id', 'name']);

        // Total produits (incluant les enfants)
        $categories->each(function ($category) {
            $childrenProductsCount = 0;
            if ($category->children) {
                foreach ($category->children as $child) {
                    $childrenProductsCount += $child->products->count();
                }
            }
            $category->total_products_count = $category->direct_products_count + $childrenProductsCount;
        });

        // ✅ Produits à afficher dans la landing page

        $products = Product::where('is_active', true)
            ->orderByDesc('likes_count')
            ->take(10)
            ->get(['id', 'name', 'description', 'price', 'discount_price', 'currency', 'images', 'stock', 'is_active']);

        $featured = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $promos = Product::where('is_active', true)
            ->whereNotNull('discount_price')
            ->orderByRaw('(price - discount_price) desc')
            ->take(6)
            ->get();

        $latest = Product::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'categories',
            'products',   // populaires
            'featured',   // vedettes
            'promos',     // en promo
            'latest'      // nouveautés
        ));
    }
}
