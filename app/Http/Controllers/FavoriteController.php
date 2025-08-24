<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $req)
    {
        return $req->user()
            ->belongsToMany(Product::class, 'favorites')
            ->select('products.id','name','price','currency','images')
            ->get();
    }

    public function store(Request $req, Product $product)
    {
        $req->user()->favorites()->syncWithoutDetaching([$product->id]);
        return response()->json(['ok'=>true]);
    }

    public function destroy(Request $req, Product $product)
    {
        $req->user()->favorites()->detach($product->id);
        return response()->json(['ok'=>true]);
    }
}
