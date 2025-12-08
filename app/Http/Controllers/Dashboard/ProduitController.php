<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Produit\StoreProduitAction;
use App\Actions\Produit\UpdateProduitAction;
use App\DTOs\ProduitDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function show()
    {
        $marques = Marque::all();
        return view('site.produits', compact('marques'));
    }
   public function index(){
       $produits = Produit::paginate(9);
       $marques = Marque::all();
       $categories = Categorie::all();
       return view('dashboard.produit', compact('produits', 'marques', 'categories'));
   }
    // index
    public function store(ProduitRequest $request, StoreProduitAction $action){

       $dto = ProduitDTO::formRequest($request);
       $produits = $action->execute($dto);

       return redirect()->back()->with('produits', $produits);

    }
    // update
    public function update(ProduitRequest $request, UpdateProduitAction $action){

    }
    // delete

    public function destroy(Produit $produit){

    }
}
