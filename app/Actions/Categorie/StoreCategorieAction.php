<?php

namespace App\Actions\Categorie;

use App\DTOs\CategorieDTO;
use App\DTOs\MarqueDTO;
use App\Models\Categorie;

class StoreCategorieAction
{
    public static function execute(CategorieDTO $dto): Categorie{
        $categorie = Categorie::create([
            'name'=> $dto->name,
        ]);
        return $categorie;
    }

}
