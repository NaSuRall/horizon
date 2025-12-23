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
        // --- Mise à jour des champs simples ---
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

        $produit->save();

        // --- Mise à jour des catégories ---
        if (!empty($dto->categories)) {

            $categories = collect($dto->categories)
                ->flatMap(function ($catId) {
                    $cat = Categorie::find($catId);

                    if ($cat && $cat->parent_id) {
                        return [$catId, $cat->parent_id];
                    }

                    return [$catId];
                })
                ->unique()
                ->values();

            $produit->categories()->sync($categories);
        }

        // --- Remplacement des images ---
        if (!empty($dto->imagePaths)) {

            // 1. Supprimer les anciennes images (DB + fichiers)
            foreach ($produit->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->path);
                $oldImage->delete();
            }

            // 2. Ajouter les nouvelles images (déjà stockées par le DTO)
            foreach ($dto->imagePaths as $path) {
                $produit->images()->create([
                    'path' => $path
                ]);
            }
        }

        // --- Log activité ---
        Activity::create([
            'type' => 'Produit',
            'action' => 'Update',
            'user_id' => auth()->id(),
            'description' => "{$produit->name} modifié"
        ]);

        return $produit;
    }
}
