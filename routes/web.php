<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\ActualiteController;
use App\Http\Controllers\Dashboard\CategorieController;
use App\Http\Controllers\Dashboard\MarqueController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\ProduitController;
use App\Models\Produit;
use Illuminate\Support\Facades\Route;

// ----------------------
// Partie publique (SITE)
// ----------------------
Route::get('/', function () {
    $produits = Produit::latest()->take(6)->get();
    $lastActu = \App\Models\Actualite::latest()->first();
    return view('welcome', compact('produits', 'lastActu'));
})->name('accueil');
Route::get('/about', function () {
    $produits = Produit::all();
    return view('site.presentation', compact('produits'));
})->name('site.about');
Route::get('/produits', [ProduitController::class, 'show'])->name('site.show.produits');
Route::get('/contact', function () {
    return view('site.contact');
})->name('site.contact');
Route::get('/actualites', [ActualiteController::class, 'show'])->name('actualites.show');
Route::post('/contact', [\App\Http\Controllers\Mail\ContactController::class, 'sendContact'])->name('contact.send');



Route::get('/mentions-legales', function () {
    return view('site.mentionsLegales');
})->name('site.mentions');

Route::get('/politique-de-confidentialite', function () {
    return view('site.politiqueConfidentialite');
})->name('site.politique');
// ----------------------
// Authentification
// ----------------------
Auth::routes(['register' => false]); // désactive l'inscription publique
Route::post('login', [LoginController::class, 'login'])->middleware('throttle:5,1');

// ----------------------
// Partie privée (DASHBOARD)
// ----------------------
// Protégée par auth + is_admin
Route::middleware(['auth', 'is_admin'])->prefix('dashboard')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    // Marques
    Route::get('/marques', [MarqueController::class, 'index'])->name('marques.index');
    Route::post('/marques', [MarqueController::class, 'store'])->name('marques.store');
    Route::get('/marques/{id}/delete', [MarqueController::class, 'destroy'])->name('marques.delete');
    Route::put('/marques/{marque}', [MarqueController::class, 'update'])->name('marques.update');

    // Catégories
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/delete', [CategorieController::class, 'destroy'])->name('categories.delete');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');

    // Membres
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}/delete', [MemberController::class, 'destroy'])->name('members.delete');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');

    // Produits
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.delete');

    // Activités
    Route::get('/activity', [ActivityController::class, 'index'])->name('activities.index');


    // Actualités
    Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualite.index');
    Route::post('/actualites', [ActualiteController::class, 'store'])->name('actualites.store');
    Route::put('/actualites/{actualite}', [ActualiteController::class, 'update'])->name('actualites.update');
    Route::delete('/actualites/{actualite}', [ActualiteController::class, 'delete'])->name('actualites.delete');


});
