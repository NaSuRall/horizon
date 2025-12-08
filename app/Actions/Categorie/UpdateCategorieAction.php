<?php

namespace App\Actions\Categorie;

use App\DTOs\CategorieDTO;
use App\Models\Activity;
use App\Models\Categorie;

class UpdateCategorieAction
{
    public static function execute(CategorieDTO $dto, $categorie): Categorie{
        if ($dto->name !== null) {
            $categorie->name = $dto->name;
        }
        $categorie->save();


        Activity::create([
            'type' => 'Categorie',
            'action' => 'Update',
            'user_id' => auth()->id(),
            'description' => "{$categorie->name} Modifier"
        ]);
        return $categorie;
    }
}
