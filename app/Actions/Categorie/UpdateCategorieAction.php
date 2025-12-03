<?php

namespace App\Actions\Categorie;

use App\DTOs\CategorieDTO;
use App\Models\Categorie;

class UpdateCategorieAction
{
    public static function execute(CategorieDTO $dto, $categorie): Categorie{
        if ($dto->name !== null) {
            $categorie->name = $dto->name;
        }
        $categorie->save();
        return $categorie;
    }
}
