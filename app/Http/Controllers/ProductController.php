<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // décommente si tu veux limiter la création/édition aux admins
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['index', 'show']);
    // }

  // app/Http/Controllers/ProductController.php
public function index(\Illuminate\Http\Request $r)
{
    $q = \App\Models\Product::query()->with('categories');

    // seulement actifs par défaut
    if ($r->boolean('only_active', true)) {
        $q->where('is_active', true);
    }

    // filtre catégorie ?category_id=ID
    if ($r->filled('category_id')) {
        $catId = (int) $r->input('category_id');
        $q->whereHas('categories', fn($cq) => $cq->where('categories.id', $catId));
    }

    // tri optionnel ?sort=price-asc|price-desc|newest
    switch ($r->input('sort')) {
        case 'price-asc':  $q->orderBy('price'); break;
        case 'price-desc': $q->orderByDesc('price'); break;
        default:           $q->latest();
    }

    return $q->paginate($r->integer('per_page', 20));
}


    public function show(Product $product)
    {
        return $product;
    }

// app/Http/Controllers/ProductController.php

public function store(\Illuminate\Http\Request $r)
{
    $data = $r->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'currency'    => 'nullable|string|max:10',
        'stock'       => 'nullable|integer|min:0',
        'is_active'   => 'boolean',

        // images (URLs + upload)
        'images'      => 'nullable|array',
        'images.*'    => 'url',
        'files'       => 'nullable|array',
        'files.*'     => 'image|mimes:jpg,jpeg,png,webp|max:3072',

        // catégories
        'category_id'   => 'nullable|exists:categories,id',     // select simple
        'category_ids'  => 'nullable|array',                    // si multi-select
        'category_ids.*'=> 'exists:categories,id',
    ]);

    $data['currency'] = $data['currency'] ?? 'EUR';
    $data['stock']    = $data['stock'] ?? 0;

    // Construire images[]
    $imageUrls = $data['images'] ?? [];
    if ($r->hasFile('files')) {
        foreach ($r->file('files') as $file) {
            $path = $file->store('products', 'public');
            $imageUrls[] = asset('storage/'.$path);
        }
    }
    $data['images'] = $imageUrls;

    // On enlève les champs qui ne sont pas en colonne de products
    unset($data['category_id'], $data['category_ids']);

    $p = \App\Models\Product::create($data);

    // Attacher la/les catégories au pivot
    $ids = [];
    if ($r->filled('category_ids')) {
        $ids = array_values(array_unique($r->input('category_ids', [])));
    } elseif ($r->filled('category_id')) {
        $ids = [(int) $r->input('category_id')];
    }
    if ($ids) {
        $p->categories()->sync($ids);
    }

    return response()->json($p->load('categories'), 201);
}

public function update(\Illuminate\Http\Request $r, \App\Models\Product $product)
{
    $data = $r->validate([
        'name'        => 'sometimes|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'sometimes|numeric|min:0',
        'currency'    => 'sometimes|string|max:10',
        'stock'       => 'sometimes|integer|min:0',
        'is_active'   => 'boolean',

        'images'      => 'nullable|array',
        'images.*'    => 'url',
        'files'       => 'nullable|array',
        'files.*'     => 'image|mimes:jpg,jpeg,png,webp|max:3072',

        'category_id'   => 'nullable|exists:categories,id',
        'category_ids'  => 'nullable|array',
        'category_ids.*'=> 'exists:categories,id',
    ]);

    // merge images uploadées
    $imageUrls = $data['images'] ?? $product->images ?? [];
    if ($r->hasFile('files')) {
        foreach ($r->file('files') as $file) {
            $path = $file->store('products','public');
            $imageUrls[] = asset('storage/'.$path);
        }
    }
    if (isset($data['images']) || $r->hasFile('files')) {
        $data['images'] = array_values(array_unique($imageUrls));
    }

    unset($data['category_id'], $data['category_ids']);

    $product->update($data);

    // sync pivot si fourni
    if ($r->filled('category_ids')) {
        $product->categories()->sync(array_values(array_unique($r->input('category_ids'))));
    } elseif ($r->filled('category_id')) {
        $product->categories()->sync([(int) $r->input('category_id')]);
    }

    return $product->load('categories');
}


    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
