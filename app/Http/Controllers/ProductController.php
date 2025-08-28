<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

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
            case 'price-asc':
                $q->orderBy('price');
                break;
            case 'price-desc':
                $q->orderByDesc('price');
                break;
            default:
                $q->latest();
        }

        return $q->paginate($r->integer('per_page', 20));
    }

    public function discover(Request $request)
    {
        $sort = $request->get('sort', 'popular'); // popular|newest|price-asc|price-desc


        $query = Product::query()
            ->where('is_active', true);


        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'price-asc':
                $query->orderByRaw('COALESCE(discount_price, price) asc');
                break;
            case 'price-desc':
                $query->orderByRaw('COALESCE(discount_price, price) desc');
                break;
            default: // popular
                $query->orderByDesc('likes_count')->orderByDesc('views_count');
        }


        $products = $query->paginate(24)->withQueryString();


        $featured = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()->take(8)->get();


        $promos = Product::where('is_active', true)
            ->whereNotNull('discount_price')
            ->orderByRaw('(price - discount_price) desc')
            ->take(12)->get();


        return view('products.discover', compact('products', 'featured', 'promos', 'sort'));
    }



  public function show(Product $product)
{
    $related = \App\Models\Product::query()
        ->where('is_active', true)
        ->where('id', '!=', $product->id)
        ->when($product->categories()->exists(), function ($q) use ($product) {
            $catIds = $product->categories->pluck('id');
            $q->whereHas('categories', fn($cq) => $cq->whereIn('categories.id', $catIds));
        })
        ->latest()->take(8)->get();

    // Charger avis + état favoris
    $reviews = $product->reviews()->latest()->get();
    $isFavorite = false;
    if (Auth::check()) {
        $isFavorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();
    }

    return view('products.detail', compact('product', 'related', 'reviews', 'isFavorite'));
}


public function toggleFavorite(Product $product)
{
    $fav = Favorite::where('user_id', Auth::id())
                   ->where('product_id', $product->id);

    if ($fav->exists()) {
        $fav->delete();
        return back()->with('success','Retiré des favoris ❌');
    } else {
        Favorite::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
        ]);
        return back()->with('success','Ajouté aux favoris ❤️');
    }
}


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
            'category_ids.*' => 'exists:categories,id',
        ]);

        $data['currency'] = $data['currency'] ?? 'EUR';
        $data['stock']    = $data['stock'] ?? 0;

        // Construire images[]
        $imageUrls = $data['images'] ?? [];
        if ($r->hasFile('files')) {
            foreach ($r->file('files') as $file) {
                $path = $file->store('products', 'public');
                $imageUrls[] = asset('storage/' . $path);
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
            'category_ids.*' => 'exists:categories,id',
        ]);

        // merge images uploadées
        $imageUrls = $data['images'] ?? $product->images ?? [];
        if ($r->hasFile('files')) {
            foreach ($r->file('files') as $file) {
                $path = $file->store('products', 'public');
                $imageUrls[] = asset('storage/' . $path);
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

    // NEW: enregistrement d’un avis
    public function storeReview(Request $r, Product $product)
    {
        $data = $r->validate([
            'name'    => 'nullable|string|max:100',
            'stars'   => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:5',
        ]);

        $data['product_id'] = $product->id;

        Review::create($data);

        return back()->with('success', 'Avis ajouté avec succès ✅');
    }




    public function toggleLike(Request $request, Product $product)
    {
        // Like anonyme + anti-spam via session
        $likedKey = 'liked_products';
        $liked = collect(session()->get($likedKey, []));


        if ($liked->contains($product->id)) {
            // un-like
            if ($product->likes_count > 0) {
                $product->decrement('likes_count');
            }
            $liked = $liked->reject(fn($id) => (int)$id === (int)$product->id);
        } else {
            $product->increment('likes_count');
            $liked = $liked->push($product->id)->unique();
        }


        session()->put($likedKey, $liked->values()->all());


        return response()->json([
            'ok' => true,
            'likes' => $product->likes_count,
            'liked' => $liked->contains($product->id),
        ]);
    }


    public function trackView(Request $request, Product $product)
    {
        // Compte une "vue" quand la carte est visible (IntersectionObserver)
        // Anti-refresh (1 vue / session / produit / 12h)
        $key = 'viewed_product_' . $product->id;
        $last = session()->get($key);
        if (!$last || now()->diffInHours($last) >= 12) {
            $product->increment('views_count');
            session()->put($key, now());
        }
        return response()->json(['ok' => true, 'views' => $product->views_count]);
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
