<?php

namespace App\Actions\Marque;

use App\DTOs\MarqueDTO;
use App\Models\Marque;

class StoreMarqueAction
{
    public function __construct() {}

    public function execute(MarqueDTO $dto): Marque
    {
        $marques = Marque::create([
            'name' => $dto->name,
            'description' => $dto->description,
        ]);
        return $marques;
    }
}
