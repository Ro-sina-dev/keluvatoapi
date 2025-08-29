<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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

        // Calculer le nombre total de produits pour chaque catégorie (incluant les enfants)
        $categories->each(function ($category) {
            $childrenProductsCount = 0;
            if ($category->children) {
                foreach ($category->children as $child) {
                    $childrenProductsCount += $child->products->count();
                }
            }
            $category->total_products_count = $category->direct_products_count + $childrenProductsCount;
        });

        return view('welcome', compact('categories'));
    }
}
