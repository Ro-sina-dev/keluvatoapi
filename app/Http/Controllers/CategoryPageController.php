<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryPageController extends Controller
{
    public function show($id, Request $request)
    {
        // Récupérer la catégorie avec ses enfants et produits
        $category = Category::with([
            'children' => function ($q) {
                $q->select('id', 'parent_id', 'name')
                  ->with(['products' => function ($pq) {
                      $pq->where('is_active', true)
                         ->select('id', 'name', 'description', 'price', 'currency', 'images', 'stock', 'is_active')
                         ->latest();
                  }]);
            },
            'products' => function ($q) {
                $q->where('is_active', true)
                  ->select('id', 'name', 'description', 'price', 'currency', 'images', 'stock', 'is_active')
                  ->latest();
            }
        ])->findOrFail($id);

        // Compter le total de produits
        $totalProducts = $category->products->count();
        if ($category->children) {
            foreach ($category->children as $child) {
                $totalProducts += $child->products->count();
            }
        }

        return view('categories.show', compact('category', 'totalProducts'));
    }
}
