<?php

namespace App\Actions\Actualite;

use App\DTOs\ActualiteDTO;
use App\DTOs\CategorieDTO;
use App\Models\Activity;
use App\Models\Actualite;
use App\Models\Categorie;

class StoreActualiteAction
{
    public static function execute(ActualiteDTO $dto): Actualite{
        $actualite = Actualite::create([
            'titre'=> $dto->titre,
            'contenu'=> $dto->contenu,
            'image' => $dto->imagePath,
        ]);

        Activity::create([
            'type' => 'Actualite',
            'action' => 'créé',
            'user_id' => auth()->id(),
            'description' => "Categorie {$dto->titre} ajouté"
        ]);

        return $actualite;
    }
}
