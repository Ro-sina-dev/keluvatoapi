<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminStatsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;

Route::prefix('v1')->group(function () {
    // --- Public (non authentifié)
    Route::post('register-client', [AuthController::class, 'registerClient']);
    Route::post('register-pro',    [AuthController::class, 'registerPro']);
    Route::post('login',           [AuthController::class, 'login']);


Route::get('categories', [CategoryController::class, 'index']);

// Nouvelles routes pour l'affichage frontend
Route::get('categories/display', [CategoryController::class, 'forDisplay']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::get('categories/{id}/products', [CategoryController::class, 'getProducts']); // Produits par catégorie


// Routes pour les produits
Route::get('products', [ProductController::class, 'index']); // AJOUTEZ CETTE LIGNE pour la lecture publique
Route::get('products/{product}', [ProductController::class, 'show']); // AJOUTEZ CETTE LIGNE pour voir un produit


     Route::get('/search', [SearchController::class, 'index'])->name('api.search');
             Route::apiResource('products', ProductController::class)->only(['store', 'update', 'destroy']);

    // --- Authentifié (Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me',     [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        // PRO uniquement (exemple)
        Route::middleware('role:pro')->get('pro/only', fn() => response()->json(['ok' => true]));

        // ADMIN uniquement
        Route::middleware('admin')->group(function () {
            Route::get('admin/only',  fn() => response()->json(['ok' => true]));
            Route::get('admin/stats', [AdminStatsController::class, 'index']);
            // Lecture produits publique admin

            // Écriture produits (protégée admin)
        });
    });
});
