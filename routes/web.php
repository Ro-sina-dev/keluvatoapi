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




use App\Http\Controllers\Admin\DashboardController; // admin

// =============================
// 📌 Page d'accueil
// =============================
Route::get('/', fn () => view('welcome'))->name('home');

// =============================
// 🔐 Authentification (publique)
// =============================
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});


Route::get('/decouvrir', [ProductController::class, 'discover'])->name('products.discover');
Route::post('/products/{product}/like', [ProductController::class, 'toggleLike'])->name('products.like');
Route::post('/products/{product}/view'
, [ProductController::class, 'trackView'])->name('products.view');



Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

    // avis
Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])
    ->name('products.review');

// favoris (nécessite login)
Route::post('/products/{product}/favorite', [ProductController::class, 'toggleFavorite'])
    ->middleware('auth')
    ->name('products.favorite');


    Route::get('/mes-favoris', [FavoriteController::class, 'index'])
    ->middleware('auth')
    ->name('favorites.index');

// inscriptions via POST (si tu utilises des formulaires custom)
Route::post('/register-client', [AuthController::class, 'registerClient'])->name('register.client');
Route::post('/register-pro', [AuthController::class, 'registerPro'])->name('register.pro');

// logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

// =============================
// 🔍 Recherche
// =============================
// Route::get('/search', [SearchController::class, 'index'])->name('search');



Route::get('/search', [SearchController::class, 'results'])->name('search.results');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');
// =============================
// 📂 Catégories (publiques)
// =============================
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/display', [CategoryController::class, 'forDisplay']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProducts']);

// =============================
// 🛍️ Produits (publics)
// =============================
Route::get('/products', [ProductController::class, 'index']);
 //Route::get('/products/{product}', [ProductController::class, 'show']);

// =============================
// 👤 Espace connecté (web)
// =============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');


    // avatar (même si l'image est en localStorage, la route existe)
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

// mot de passe oublié (si la vue existe)
Route::get('/forgot-password', fn () => view('auth.forgot-password'))
    ->middleware('guest')
    ->name('password.request');

// =============================
// 🔐 Admin (interface web) - AJOUT MANQUANT
// =============================
Route::middleware(['auth','admin'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

// ✅ Routes exclusives ADMIN via API (pas l'interface web)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/only', fn() => response()->json(['ok' => true]));
        Route::get('/admin/stats', [AdminStatsController::class, 'index']);
    });

// =============================
// Route de debug temporaire
// =============================
Route::get('/check-role', function() {
    if (Auth::check()) {
        return response()->json([
            'user_id' => Auth::user()->id,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
            'name' => Auth::user()->name,
            'admin_route_exists' => Route::has('admin.dashboard')
        ]);
    }
    return response()->json(['authenticated' => false]);
})->middleware('auth');

// =============================
// 🔒 API Authentifiée (Sanctum)
// =============================
Route::middleware('auth:sanctum')->group(function () {
    // CRUD produits via API
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);


});

   //Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');



Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Panier (maj quantités / suppression)
Route::post('/checkout/cart', [CheckoutController::class, 'updateCart'])->name('checkout.cart.update');

// Sauvegarder livraison → aller au paiement
Route::post('/checkout/delivery', [CheckoutController::class, 'saveDelivery'])->name('checkout.delivery.save');

// Afficher paiement
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');

// Placer la commande (paiement simulé) → confirmation
Route::post('/checkout/place', [CheckoutController::class, 'place'])->name('checkout.place');

// Page de confirmation
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

