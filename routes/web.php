<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminStatsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryPageController;

// =============================
// 📌 Page d'accueil
// =============================
Route::get('/', [WelcomeController::class, 'index'])->name('home');


// Test route sans middleware admin d'abord
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
// =============================
// 🔐 Authentification (publique)
// =============================
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Inscriptions via POST (si tu utilises des formulaires custom)
    Route::post('/register-client', [AuthController::class, 'registerClient'])->name('register.client');
    Route::post('/register-pro', [AuthController::class, 'registerPro'])->name('register.pro');

    // Mot de passe oublié
    Route::get('/forgot-password', fn () => view('auth.forgot-password'))->name('password.request');
});

// =============================
// 🔓 Déconnexion
// =============================
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

// =============================
// 🛍️ Produits (publics)
// =============================
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/decouvrir', [ProductController::class, 'discover'])->name('products.discover');

// Actions sur les produits (publiques)
Route::post('/products/{product}/like', [ProductController::class, 'toggleLike'])->name('products.like');
Route::post('/products/{product}/view', [ProductController::class, 'trackView'])->name('products.view');
Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])->name('products.review');

// =============================
// 📂 Catégories (publiques)
// =============================
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/display', [CategoryController::class, 'forDisplay'])->name('categories.display');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/products', [CategoryController::class, 'getProducts'])->name('categories.products');

// Page dédiée pour afficher les produits d'une catégorie
Route::get('/categorie/{id}', [CategoryPageController::class, 'show'])->name('category.page');

// =============================
// 🔍 Recherche (publique)
// =============================
Route::get('/search', [SearchController::class, 'results'])->name('search.results');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

// =============================
// 🛒 Panier et Checkout (publique)
// =============================
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/sync', [CheckoutController::class, 'syncCart'])->name('checkout.sync');
Route::post('/checkout/cart', [CheckoutController::class, 'updateCart'])->name('checkout.cart.update');
Route::post('/checkout/delivery', [CheckoutController::class, 'saveDelivery'])->name('checkout.delivery.save');
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/checkout/place', [CheckoutController::class, 'place'])->name('checkout.place');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// =============================
// 👤 Espace connecté (auth requis)
// =============================
Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // Commandes utilisateur
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    // Favoris (nécessite login)
    Route::post('/products/{product}/favorite', [ProductController::class, 'toggleFavorite'])->name('products.favorite');
    Route::get('/mes-favoris', [FavoriteController::class, 'index'])->name('favorites.index');


});



// =============================
// 🔐 Admin (interface web)
// =============================

// =============================
// 🔒 API Authentifiée (Sanctum)
// =============================
Route::middleware('auth:sanctum')->group(function () {
    // CRUD produits via API
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});
