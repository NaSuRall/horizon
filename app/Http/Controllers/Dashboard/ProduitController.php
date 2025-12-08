<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Produit\StoreProduitAction;
use App\Actions\Produit\UpdateProduitAction;
use App\DTOs\ProduitDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;
use App\Http\Requests\ProduitUpdateRequest;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Http\Request;


class ProduitController extends Controller
{
    public function show(Request $request)
    {
        $query = Produit::query();

        // Recherche par nom
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtre prix
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filtre marques
        if ($request->filled('marques')) {
            $query->whereIn('marque_id', $request->marques);
        }

        // Filtre catégories (relation many-to-many)
        if ($request->filled('categories')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }

        $produits = $query->paginate(12);

        $marques = Marque::all();
        $categories = Categorie::all();

        return view('site.produits', compact('produits', 'marques', 'categories'));
    }

    public function index()
    {
        $produits = Produit::paginate(9);
        $marques = Marque::all();
        $categories = Categorie::all();
        return view('dashboard.produit', compact('produits', 'marques', 'categories'));
    }

    // store
    public function store(ProduitRequest $request, StoreProduitAction $action)
    {
        $dto = ProduitDTO::formRequest($request);
        $produit = $action->execute($dto);

        return redirect()->route('produits.index')->with('success', 'Produit créé avec succès');
    }

    // update
    public function update(ProduitUpdateRequest $request, UpdateProduitAction $action, Produit $produit)
    {
        $dto = ProduitDTO::formRequest($request);
        $produit = $action->execute($dto, $produit);

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès');

    }

    // delete
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès');
    }
}
