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


// =============================
// 📌 Page d'accueil
// =============================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// =============================
// 🔐 Authentification (publique)
// =============================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


//Route::get('/checkout', function () {
  //  if (!Auth::check()) {
   //     return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder au panier.');
  //  }
  //  return view('checkout');
//})->name('checkout');



Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register-client', [AuthController::class, 'registerClient'])->name('register.client');
Route::post('/register-pro', [AuthController::class, 'registerPro'])->name('register.pro');





Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// =============================
// 🔍 Recherche
// =============================
Route::get('/search', [SearchController::class, 'index'])->name('search');

// =============================
// 📂 Catégories
// =============================
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/display', [CategoryController::class, 'forDisplay']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProducts']);

// Route vers les commandes
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('orders');


// Mot de passe oublié (déjà généré si tu as Breeze ou Laravel UI avec auth)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Modifier avatar (fake, puisque tu stockes en localStorage, mais Laravel doit avoir cette route)
Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->middleware('auth')->name('profile.avatar.update');

// =============================
// 🛍️ Produits (publics)
// =============================
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// =============================
// 👤 Utilisateur connecté
// =============================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

// =============================
// 🔐 Admin (interface web)
// =============================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

// =============================
// 🔒 API Authentifiée (Sanctum)
// =============================
Route::middleware('auth:sanctum')->group(function () {
    // Création, modification, suppression de produits
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // ✅ Routes exclusives PRO
    Route::middleware('role:pro')->group(function () {
        Route::get('/pro/only', fn() => response()->json(['ok' => true]));
        // ➕ Tu peux ajouter d'autres routes pro ici
    });

    // ✅ Routes exclusives ADMIN
    Route::middleware('admin')->group(function () {
        Route::get('/admin/only', fn() => response()->json(['ok' => true]));
        Route::get('/admin/stats', [AdminStatsController::class, 'index']);
    });
});
