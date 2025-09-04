<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'colors'])
            ->latest()
            ->paginate(10);
            
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $colors = Color::all();
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('colors', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors' => 'array',
            'colors.*' => 'exists:colors,id',
        ]);

        // Gestion du téléchargement des images
        $imagePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }

        // Création du produit
        $product = Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'images' => $imagePaths,
            'is_active' => $request->has('is_active') ? $request->input('is_active') : true,
        ]);

        // Attachement des catégories
        if (!empty($validated['categories'])) {
            $product->categories()->attach($validated['categories']);
        }

        // Attachement des couleurs
        if (!empty($validated['colors'])) {
            $product->colors()->attach($validated['colors']);
        }

        return redirect()->back()
            ->with('success', 'Produit créé avec succès.');
    }
}
