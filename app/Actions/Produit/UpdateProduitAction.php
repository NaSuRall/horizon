<?php

namespace App\Actions\Produit;

use App\DTOs\ProduitDTO;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Support\Facades\Storage;

class UpdateProduitAction
{
    public static function execute(ProduitDTO $dto, Produit $produit): Produit
    {
        try {

            // --- Mise à jour des champs simples ---
            if ($dto->name !== null) $produit->name = $dto->name;
            if ($dto->description !== null) $produit->description = $dto->description;
            if ($dto->ref !== null) $produit->ref = $dto->ref;
            if ($dto->price !== null) $produit->price = $dto->price;
            if ($dto->marque_id !== null) $produit->marque_id = $dto->marque_id;

            $produit->save();

            // --- Mise à jour des catégories ---
            if (!empty($dto->categories)) {
                $categories = collect($dto->categories)
                    ->flatMap(function ($catId) {
                        $cat = Categorie::find($catId);
                        return ($cat && $cat->parent_id)
                            ? [$catId, $cat->parent_id]
                            : [$catId];
                    })
                    ->unique()
                    ->values();

                $produit->categories()->sync($categories);
            }

            // --- Remplacement des images ---
            if (!empty($dto->imagePaths)) {

                foreach ($produit->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->path);
                    $oldImage->delete();
                }

                foreach ($dto->imagePaths as $path) {
                    $produit->images()->create(['path' => $path]);
                }
            }

            Activity::create([
                'type' => 'Produit',
                'action' => 'Update',
                'user_id' => auth()->id(),
                'description' => "{$produit->name} modifié"
            ]);

            return $produit;

        } catch (\Throwable $e) {

            // On relance une exception propre
            throw new \Exception("Erreur lors de la modification du produit : " . $e->getMessage());
        }
    }
}
