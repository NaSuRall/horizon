<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Produit\StoreProduitAction;
use App\DTOs\ProduitDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
   public function index(){
       $produits = Produit::all();
       return view('dashboard.produit', compact('produits'));
   }
    // index
    public function store(ProduitRequest $request, StoreProduitAction $action){

       $dto = ProduitDTO::formRequest($request);
       $produits = $action->execute($dto);

       return view('dashboard.produit', compact('produits'));

    }
    // update

    // delete
}
