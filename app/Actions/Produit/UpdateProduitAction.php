<?php

namespace App\Actions\Produit;

use App\DTOs\ProduitDTO;
use App\Models\Activity;
use App\Models\Produit;

class UpdateProduitAction
{
    public static function execute(ProduitDTO $dto, Produit $produit): Produit
    {
        if ($dto->name !== null) {
            $produit->name = $dto->name;
        }
        if ($dto->description !== null) {
            $produit->description = $dto->description;
        }
        if ($dto->ref !== null) {
            $produit->ref = $dto->ref;
        }
        if ($dto->price !== null) {
            $produit->price = $dto->price;
        }
        if ($dto->marque_id !== null) {
            $produit->marque_id = $dto->marque_id;
        }
        if ($dto->imagePath !== null) {
            $produit->image = $dto->imagePath;
        }

        $produit->save();

        if (!empty($dto->categories)) {
            $produit->categories()->sync($dto->categories);
        }

        Activity::create([
            'type' => 'Produit',
            'action' => 'Update',
            'user_id' => auth()->id(),
            'description' => "{$produit->name} crée"
        ]);

        return $produit;

    }
}
