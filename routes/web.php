<?php

use App\Http\Controllers\Dashboard\MarqueController;
use \App\Http\Controllers\Dashboard\CategorieController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\ProduitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/dashboard/marques', [MarqueController::class, 'index'])->name('marques.index');
Route::post('/dashboard/marques', [MarqueController::class, 'store'])->name('marques.store');
Route::get('/dashboard/{id}/marque', [MarqueController::class, 'destroy'])->name('marques.delete');
Route::put('/dashboard/{marque}/marque', [MarqueController::class, 'update'])->name('marques.update');

Route::get('/dashboard/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::post('/dashboard/categorie', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/dashboard/{id}/categorie', [CategorieController::class, 'destroy'])->name('categories.delete');
Route::put('/dashboard/{categorie}/categorie', [CategorieController::class, 'update'])->name('categories.update');

Route::get('/dashboard/member', [MemberController::class, 'index'])->name('members.index');
Route::post('/dashboard/member', [MemberController::class, 'store'])->name('members.store');
Route::get('/dashboard/{id}/member', [MemberController::class, 'destroy'])->name('members.delete');
Route::put('/dashboard/{member}/member', [MemberController::class, 'update'])->name('members.update');


Route::get('/dashboard/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/dashboard/produits', [ProduitController::class, 'store'])->name('produits.store');
