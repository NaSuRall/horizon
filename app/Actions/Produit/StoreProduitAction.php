<?php

namespace App\Actions\Produit;

use App\DTOs\ProduitDTO;
use App\Models\Produit;

class StoreProduitAction
{

    public function __construct(){
    }



    public function execute(ProduitDTO $dto){

        $produits = Produit::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
            'ref' => $dto->ref,
            'marque_id' => $dto->marque_id,
            'image' => $dto->image,
        ]);
        return $produits;
    }
}
