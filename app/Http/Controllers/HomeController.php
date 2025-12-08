<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $marques = Marque::withCount('produits')->get();
        $categories = Categorie::withCount('produits')->get();
        $users = User::all();
        $produits = Produit::all();
        return view('dashboard.dashboard', compact('marques', 'categories', 'users', 'produits'));
    }
}
