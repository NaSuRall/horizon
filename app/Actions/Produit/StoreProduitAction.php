<?php


namespace App\Actions\Produit;

use App\DTOs\ProduitDTO;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class StoreProduitAction
{
    public function execute(ProduitDTO $dto): Produit
    {
        return DB::transaction(function () use ($dto) {

            $produit = Produit::create([
                'name' => $dto->name,
                'description' => $dto->description,
                'price' => $dto->price,
                'ref' => $dto->ref,
                'marque_id' => $dto->marque_id,
                'image' => $dto->imagePath,
            ]);

            $categories = collect($dto->categories ?? [])
                ->flatMap(function ($catId) {
                    $cat = Categorie::find($catId);
                    return $cat && $cat->parent_id
                        ? [$catId, $cat->parent_id]
                        : [$catId];
                })
                ->unique()
                ->values();

            $produit->categories()->sync($categories);

            Activity::create([
                'type' => 'Produit',
                'action' => 'Create',
                'user_id' => auth()->id(),
                'description' => "{$produit->name} créé"
            ]);

            return $produit;
        });
    }
}

