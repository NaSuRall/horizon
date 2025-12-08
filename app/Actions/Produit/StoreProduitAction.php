<?php
namespace App\Actions\Produit;

use App\DTOs\ProduitDTO;
use App\Models\Activity;
use App\Models\Produit;

class StoreProduitAction
{
    public function execute(ProduitDTO $dto): Produit
    {
        $produit = Produit::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
            'ref' => $dto->ref,
            'marque_id' => $dto->marque_id,
            'image' => $dto->imagePath,
        ]);

        // Synchroniser les catégories (pivot)
        if (!empty($dto->categories)) {
            $produit->categories()->sync($dto->categories);
        }


        Activity::create([
            'type' => 'Produit',
            'action' => 'Crée',
            'user_id' => auth()->id(),
            'description' => "{$produit->name} crée"
        ]);

        return $produit;
    }
}
